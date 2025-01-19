<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Display user profile
    public function show()
    {
        $user = Auth::user();

        // Get the friend IDs from the 'friends' array (or an empty array if 'friends' is null)
        $friendIds = $user->friends ?? [];

        // If there are no friends, we don't need to query for them
        $friends = [];
        if (count($friendIds) > 0) {
            // Get the friends' information from the 'users' table using the friend IDs
            $friends = User::whereIn('id', $friendIds)->get();
        }

        return view('profile', compact('user', 'friends'));
    }
}
