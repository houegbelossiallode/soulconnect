<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-white leading-tight">
                    {{ __('Messaging') }}
                </h2>
                <p class="text-white/40 text-sm mt-1 uppercase tracking-tighter">{{ __('Chat with your crushes') }}</p>
            </div>
            <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-emerald-500/10 rounded-full border border-emerald-500/20 shadow-lg shadow-emerald-500/5">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">{{ __('Secure Chat Active') }}</span>
            </div>
        </div>
    </x-slot>

    <!-- Container principal Forcé en ligne (Split View) -->
    <div class="flex h-[800px] gap-8 antialiased pb-8 relative">
        
        <!-- Sidebar GAUCHE : Liste des contacts (Raffinée) -->
        <aside class="hidden sm:flex flex-col w-[380px] shrink-0 gap-6">
            <div class="relative group">
                <span class="absolute left-6 top-1/2 -translate-y-1/2 text-xl opacity-20 group-focus-within:opacity-50 transition-opacity">🔍</span>
                <input type="text" placeholder="{{ __('Search a match...') }}" 
                       class="w-full pl-16 pr-6 py-5 bg-white/5 border-white/5 rounded-[2.5rem] text-sm text-white focus:bg-white/10 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500/40 transition-all placeholder:text-white/20 shadow-inner">
            </div>

            <div class="flex-1 glass rounded-[3rem] border-white/10 overflow-hidden flex flex-col shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                <div class="px-8 py-7 border-b border-white/5 bg-gradient-to-r from-white/[0.03] to-transparent">
                    <h3 class="text-[11px] font-black text-rose-500 uppercase tracking-[0.4em] drop-shadow-sm">{{ __('My Conversations') }}</h3>
                </div>
                
                <div class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-2">
                    @forelse($conversations as $conversation)
                        @php
                            $otherUser = $conversation->otherUser();
                            $lastMsg = $conversation->messages->first();
                            $isActive = isset($activeConversation) && $activeConversation->id === $conversation->id;
                        @endphp
                        <a href="{{ route('messages.index', ['conversation_id' => $conversation->id]) }}" 
                           class="w-full flex items-center gap-5 p-5 rounded-[2.2rem] transition-all duration-300 {{ $isActive ? 'bg-gradient-to-r from-rose-500/20 to-transparent border border-rose-500/30' : 'hover:bg-white/5 opacity-40 hover:opacity-100' }} group">
                            <div class="relative shrink-0">
                                <img src="https://i.pravatar.cc/150?u={{ $otherUser->id }}" class="w-14 h-14 rounded-2xl object-cover ring-2 {{ $isActive ? 'ring-rose-500/50' : 'ring-white/10' }} group-hover:scale-105 transition-transform duration-500">
                                @if($isActive)
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 border-[3px] border-[#0a0104] rounded-full shadow-lg"></div>
                                @endif
                            </div>
                            <div class="flex-1 text-left relative z-10">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-bold text-white text-lg">{{ $otherUser->name }}</span>
                                    <span class="text-[10px] {{ $isActive ? 'text-rose-400' : 'text-white/20' }} font-black tracking-widest">
                                        {{ $conversation->last_message_at ? $conversation->last_message_at->format('H:i') : '' }}
                                    </span>
                                </div>
                                <p class="text-xs {{ $isActive ? 'text-rose-400/90' : 'text-white/30' }} truncate font-semibold">
                                    @if($lastMsg)
                                        @if($lastMsg->type === 'text') {{ $lastMsg->body }} @else [Multimédia] @endif
                                    @else
                                        {{ __('Say hello! 👋') }}
                                    @endif
                                </p>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-10 opacity-20 italic text-sm">{{ __('No exchange for now... A little boldness? 😉') }}</div>
                    @endforelse
                </div>
            </div>
        </aside>

        <!-- Main DROITE : Zone de Chat (Ultra-Immersive) -->
        <main class="flex-1 flex flex-col glass rounded-[4rem] border-white/20 shadow-[0_30px_100px_rgba(0,0,0,0.8)] overflow-hidden relative">
            
            <!-- Fond Décoratif Subtil -->
            <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-rose-500/10 rounded-full blur-[120px] -mr-64 -mt-64"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[120px] -ml-64 -mb-64"></div>
            </div>

            <!-- Header Discussion -->
            <div class="relative z-10 px-10 py-8 border-b border-white/10 bg-white/[0.02] backdrop-blur-md flex items-center justify-between">
                @if($activeConversation)
                    @php $activeOtherUser = $activeConversation->otherUser(); @endphp
                    <div class="flex items-center gap-5">
                        <div class="relative group cursor-pointer">
                            <img src="https://i.pravatar.cc/150?u={{ $activeOtherUser->id }}" class="w-14 h-14 rounded-2xl object-cover ring-2 ring-white/10 shadow-2xl group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 rounded-2xl ring-2 ring-rose-500/0 group-hover:ring-rose-500/50 transition-all duration-500"></div>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-white flex items-center gap-3">
                                {{ $activeOtherUser->name }} 
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500 border border-black/20"></span>
                                </span>
                            </h4>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[9px] bg-rose-500 text-white px-2 py-0.5 rounded-md font-black tracking-widest uppercase">{{ __('Certified Match') }}</span>
                                <span class="text-[10px] text-white/30 uppercase tracking-[0.2em] font-black italic">{{ __('Online') }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-white/30 italic text-sm">{{ __('Select a conversation') }}</div>
                @endif
                <div class="flex gap-4">
                    <button class="w-14 h-14 flex items-center justify-center glass rounded-2xl hover:bg-white/10 transition-all text-xl shadow-lg border border-white/10 group" title="Appel">
                        <span class="group-hover:scale-110 transition-transform">📞</span>
                    </button>
                    <button class="w-14 h-14 flex items-center justify-center glass rounded-2xl hover:bg-white/10 transition-all text-xl shadow-lg border border-white/10 group" title="Video">
                        <span class="group-hover:scale-110 transition-transform">📷</span>
                    </button>
                    <button class="px-6 h-14 flex items-center gap-3 bg-gradient-to-br from-rose-500 to-rose-600 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-rose-500/30 hover:scale-105 active:scale-95 transition-all">
                        <span>❤️</span>
                        Favori
                    </button>
                </div>
            </div>

            <!-- Flow des Messages -->
            <div id="chat-flow" class="relative z-10 flex-1 overflow-y-auto px-10 py-10 space-y-10 custom-scrollbar bg-transparent">
                <div class="flex justify-center mb-4">
                    <span class="px-6 py-2 rounded-full glass border-white/5 text-[10px] font-black text-rose-500/60 uppercase tracking-[0.4em]">{{ __('Start of the story') }}</span>
                </div>

                @forelse($messages as $message)
                    {!! (App\Http\Controllers\MessageController::class)::renderMessage($message) !!}
                @empty
                    <div class="flex flex-col items-center justify-center h-full text-center opacity-30 space-y-4">
                        <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center text-2xl">✨</div>
                        <p class="text-sm font-medium">{{ __('Start the conversation with a spark!') }}</p>
                    </div>
                @endforelse

                <div id="typing-indicator" class="flex items-center gap-4 opacity-0 transition-opacity duration-300">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-[10px] font-black text-white/50 border border-white/5">...</div>
                    <div class="glass border-white/10 px-6 py-4 rounded-full bg-white/5 backdrop-blur-md">
                        <div class="flex gap-1.5">
                            <span class="w-2 h-2 bg-rose-500 rounded-full animate-bounce"></span>
                            <span class="w-2 h-2 bg-rose-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></span>
                            <span class="w-2 h-2 bg-rose-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ESPACE DE SAISIE -->
            <div class="relative z-10 p-10 border-t border-white/10 bg-white/[0.02] backdrop-blur-xl shadow-[0_-20px_50px_rgba(0,0,0,0.3)]">
                <form id="chat-form" class="flex items-center gap-6">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $activeConversation ? $activeConversation->otherUser()->id : '' }}">
                    <input type="hidden" name="type" id="message-type" value="text">
                    
                    <!-- BOUTONS MULTIMÉDIA LUXUEUX -->
                    <div class="flex gap-4 shrink-0">
                        <button type="button" id="btn-audio" class="w-16 h-16 flex flex-col items-center justify-center bg-gradient-to-br from-rose-500 to-rose-700 text-white rounded-2xl shadow-2xl shadow-rose-500/40 hover:scale-110 active:scale-95 transition-all group ring-1 ring-rose-400/50" title="{{ __('Audio') }}">
                            <span class="text-2xl group-hover:scale-110 transition-transform">🎙️</span>
                            <span class="text-[9px] font-black uppercase tracking-tighter mt-1 opacity-80">{{ __('Audio') }}</span>
                        </button>
                        <button type="button" id="btn-photo" class="w-16 h-16 flex flex-col items-center justify-center bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-2xl shadow-2xl shadow-indigo-500/40 hover:scale-110 active:scale-95 transition-all group ring-1 ring-indigo-400/50" title="{{ __('Photo') }}">
                            <span class="text-2xl group-hover:rotate-12 transition-transform">🖼️</span>
                            <span class="text-[9px] font-black uppercase tracking-tighter mt-1 opacity-80">{{ __('Photo') }}</span>
                        </button>
                        <input type="file" id="file-input" name="file" class="hidden" accept="image/*">
                    </div>

                    <!-- BARRE D'ÉCRITURE RAFFINÉE -->
                    <div class="flex-1 relative group">
                        <input type="text" id="message-body" name="body" placeholder="{{ __('Your message for Sophie...') }}" 
                               class="w-full py-6 pl-10 pr-20 bg-white/5 border-2 border-white/10 rounded-[2rem] text-white text-lg focus:bg-white/10 focus:border-rose-500/50 focus:ring-4 focus:ring-rose-500/10 outline-none transition-all placeholder:text-white/20 shadow-2xl">
                        
                        <button type="submit" id="btn-submit" class="absolute right-3 top-1/2 -translate-y-1/2 w-14 h-14 bg-gradient-to-br from-rose-500 to-rose-600 text-white rounded-2xl shadow-xl shadow-rose-500/30 flex items-center justify-center hover:scale-110 active:scale-90 transition-all group overflow-hidden">
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform"></div>
                            <svg class="w-7 h-7 rotate-90 relative z-10" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" /></svg>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('chat-form');
            const flow = document.getElementById('chat-flow');
            const body = document.getElementById('message-body');
            const btnAudio = document.getElementById('btn-audio');
            const btnPhoto = document.getElementById('btn-photo');
            const fileInput = document.getElementById('file-input');
            const typeInput = document.getElementById('message-type');
            const typingIndicator = document.getElementById('typing-indicator');

            let mediaRecorder;
            let audioChunks = [];
            let audioBlob = null;

            // Scroll to bottom
            const scrollToBottom = () => {
                flow.scrollTop = flow.scrollHeight;
            };
            scrollToBottom();

            // Envoi AJAX
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const messageType = typeInput.value;
                if (messageType === 'text' && !body.value.trim()) return;
                if (messageType === 'image' && !fileInput.files.length) return;
                if (messageType === 'audio' && !audioBlob) return;

                const formData = new FormData(form);
                
                // Si c'est un audio, on ajoute le blob manuellement avec la bonne extension
                if (messageType === 'audio' && audioBlob) {
                    const extension = audioBlob.type.includes('webm') ? 'webm' : 
                                    audioBlob.type.includes('ogg') ? 'ogg' : 'mp3';
                    formData.append('file', audioBlob, `voice_message.${extension}`);
                }
                
                const btnSubmit = document.getElementById('btn-submit');
                btnSubmit.disabled = true;
                btnSubmit.classList.add('opacity-50');

                try {
                    const response = await fetch('{{ route("messages.store") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();
                    if (data.status === 'success') {
                        typingIndicator.insertAdjacentHTML('beforebegin', data.html);
                        resetForm();
                        scrollToBottom();
                    } else {
                        alert("Erreur de validation : " + JSON.stringify(data.errors));
                    }
                } catch (error) {
                    console.error('Erreur:', error);
                    alert("Une erreur est survenue lors de l'envoi.");
                } finally {
                    btnSubmit.disabled = false;
                    btnSubmit.classList.remove('opacity-50');
                }
            });

            const resetForm = () => {
                body.value = '';
                body.placeholder = "Votre message pour Sophie...";
                fileInput.value = '';
                typeInput.value = 'text';
                audioBlob = null;
                btnAudio.classList.remove('animate-pulse', 'ring-4', 'ring-rose-500/30');
            };


            // Bouton Photo
            btnPhoto.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    typeInput.value = 'image';
                    body.value = "[Photo : " + fileInput.files[0].name + "]";
                    body.classList.add('text-indigo-400');
                    setTimeout(() => body.classList.remove('text-indigo-400'), 2000);
                }
            });

            // Bouton Audio (Vrai enregistrement)
            let isRecording = false;
            btnAudio.addEventListener('click', async () => {
                if (!isRecording) {
                    try {
                        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                        mediaRecorder = new MediaRecorder(stream);
                        audioChunks = [];

                        mediaRecorder.ondataavailable = (event) => {
                            audioChunks.push(event.data);
                        };

                        mediaRecorder.onstop = () => {
                            const blobType = mediaRecorder.mimeType || 'audio/webm';
                            audioBlob = new Blob(audioChunks, { type: blobType });
                            typeInput.value = 'audio';
                            body.value = "[Message audio enregistré]";
                        };

                        mediaRecorder.start();
                        isRecording = true;
                        btnAudio.classList.add('animate-pulse', 'ring-4', 'ring-rose-500/30');
                        body.placeholder = "Enregistrement en cours... Cliquez à nouveau pour arrêter";
                    } catch (err) {
                        alert("Accès micro refusé ou non supporté : " + err.message);
                    }
                } else {
                    mediaRecorder.stop();
                    isRecording = false;
                    btnAudio.classList.remove('animate-pulse', 'ring-4', 'ring-rose-500/30');
                    body.placeholder = "Audio capturé. Prêt à l'envoi.";
                }
            });
        });
    </script>

    <!-- Styles de barre de défilement premium -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.15);
        }
    </style>
</x-app-layout>
