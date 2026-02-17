<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DiscoverController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('id', '!=', Auth::id());

        // Filter by gender
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Filter by age range
        if ($request->filled('age_min') || $request->filled('age_max')) {
            $minDate = Carbon::now()->subYears($request->age_max ?? 100)->startOfDay();
            $maxDate = Carbon::now()->subYears($request->age_min ?? 18)->endOfDay();
            
            $query->whereBetween('birthday', [$minDate, $maxDate]);
        }

        $users = $query->inRandomOrder()->paginate(10);

        return view('discover', compact('users'));
    }
}
