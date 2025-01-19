<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hobby;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Get all unique hobbies for the dropdown
        $hobbies = Hobby::pluck('name')->unique();

        // Query users with optional filters
        $users = User::with('hobbies')
            ->when($request->search, function ($query) use ($request) {
                $query->where('username', 'like', '%' . $request->search . '%');
            })
            ->when($request->gender, function ($query) use ($request) {
                $query->where('gender', $request->gender);
            })
            ->when($request->hobby, function ($query) use ($request) {
                $query->whereHas('hobbies', function ($query) use ($request) {
                    $query->where('name', $request->hobby);
                });
            })
            ->withCount('hobbies')  // Count hobbies to prioritize users with more matching hobbies
            ->orderByDesc('hobbies_count')  // Order by how many hobbies match
            ->paginate(9);

        return view('home', compact('users', 'hobbies'));
    }
}

