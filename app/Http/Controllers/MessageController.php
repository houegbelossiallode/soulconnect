<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Récupérer toutes les conversations de l'utilisateur
        $conversations = Conversation::where('user_one_id', $user->id)
            ->orWhere('user_two_id', $user->id)
            ->with(['userOne', 'userTwo', 'messages' => function($q) {
                $q->latest()->limit(1);
            }])
            ->orderByDesc('last_message_at')
            ->get();

        $activeConversation = null;
        $messages = collect();

        // 1. Si on demande une conversation spécifique par ID
        if ($request->has('conversation_id')) {
            $activeConversation = Conversation::with('messages.sender')->find($request->conversation_id);
        } 
        // 2. Si on veut démarrer une conversation avec un utilisateur spécifique (via Discover)
        elseif ($request->has('user_id')) {
            $receiverId = $request->user_id;
            $activeConversation = Conversation::where(function($q) use ($user, $receiverId) {
                $q->where('user_one_id', $user->id)->where('user_two_id', $receiverId);
            })->orWhere(function($q) use ($user, $receiverId) {
                $q->where('user_one_id', $receiverId)->where('user_two_id', $user->id);
            })->first();

            // Si la conversation n'existe pas encore, on crée un objet "virtuel" pour la vue
            // pour que le header affiche bien le nom de la personne
            if (!$activeConversation) {
                $otherUser = User::find($receiverId);
                if ($otherUser) {
                    $activeConversation = new Conversation([
                        'user_one_id' => min($user->id, $otherUser->id),
                        'user_two_id' => max($user->id, $otherUser->id),
                    ]);
                    // On injecte les relations manuellement pour éviter les erreurs de vue
                    $activeConversation->setRelation('userOne', $user->id < $otherUser->id ? $user : $otherUser);
                    $activeConversation->setRelation('userTwo', $user->id > $otherUser->id ? $user : $otherUser);
                }
            } else {
                $activeConversation->load('messages.sender');
            }
        }
        // 3. Par défaut, prendre la dernière conversation active
        elseif ($conversations->count() > 0) {
            $activeConversation = $conversations->first()->load('messages.sender');
        }

        if ($activeConversation && $activeConversation->exists) {
            $messages = $activeConversation->messages;
        }

        return view('messages', compact('conversations', 'activeConversation', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'nullable|string',
            'receiver_id' => 'required|exists:users,id',
            'type' => 'required|string|in:text,image,audio',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp3,wav,webm,ogg,mpga|max:10240',
        ]);

        $senderId = Auth::id();
        $receiverId = $request->receiver_id;

        // Trouver ou créer la conversation
        $conversation = Conversation::where(function($q) use ($senderId, $receiverId) {
            $q->where('user_one_id', $senderId)->where('user_two_id', $receiverId);
        })->orWhere(function($q) use ($senderId, $receiverId) {
            $q->where('user_one_id', $receiverId)->where('user_two_id', $senderId);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => min($senderId, $receiverId),
                'user_two_id' => max($senderId, $receiverId),
            ]);
        }

        $body = $request->body;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('messages', 'public');
            $body = $path;
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $senderId,
            'body' => $body,
            'type' => $request->type,
            'is_read' => false,
        ]);

        $conversation->update(['last_message_at' => now()]);

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'html' => self::renderMessage($message)
        ]);
    }

    public static function renderMessage($message)
    {
        $isMine = $message->sender_id === Auth::id();
        $align = $isMine ? 'flex-row-reverse' : '';
        $senderName = $message->sender ? $message->sender->name : 'SOPHIE';
        
        // Style Ultra-Premium
        if ($isMine) {
            $bubbleStyle = 'bg-gradient-to-br from-rose-500 via-rose-600 to-rose-700 shadow-[0_10px_40px_-10px_rgba(244,63,94,0.4)] border border-rose-400/30';
            $senderLabel = 'VOUS';
            $labelStyle = 'bg-rose-500 shadow-rose-500/50';
            $rounded = 'rounded-2xl rounded-tr-none';
        } else {
            $bubbleStyle = 'glass border-white/20 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.5)] bg-white/5 backdrop-blur-xl';
            $senderLabel = strtoupper($senderName);
            $labelStyle = 'bg-white/10 shadow-black/20';
            $rounded = 'rounded-2xl rounded-tl-none';
        }

        // Contenu du message selon le type
        $content = '';
        if ($message->type === 'image') {
            $content = '<img src="' . asset('storage/' . $message->body) . '" class="max-w-full rounded-xl shadow-lg border border-white/10 hover:scale-105 transition-transform duration-500 cursor-pointer" onclick="window.open(this.src)">';
        } elseif ($message->type === 'audio') {
            $content = '
            <div class="flex items-center gap-3 min-w-[200px]">
                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-rose-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/></svg>
                </div>
                <audio controls class="h-8 opacity-80 filter invert brightness-200">
                    <source src="' . asset('storage/' . $message->body) . '" type="audio/mpeg">
                </audio>
            </div>';
        } else {
            $content = e($message->body);
        }

        return '
        <div class="flex ' . $align . ' items-start gap-4 max-w-[85%] animate-fade-in-up">
            <div class="w-10 h-10 rounded-xl ' . $labelStyle . ' flex items-center justify-center text-[10px] font-black text-white shadow-lg border border-white/10 shrink-0">
                ' . substr($senderLabel, 0, 6) . '
            </div>
            <div class="' . $bubbleStyle . ' ' . $rounded . ' p-5 text-white text-[15px] leading-relaxed relative group overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                ' . $content . '
                <div class="text-[9px] mt-2 opacity-30 font-bold uppercase tracking-widest text-right">' . $message->created_at->format('H:i') . '</div>
            </div>
        </div>';
    }
}
