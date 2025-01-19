<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
// <!-- app/http/controllers/homecontroller -->
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::paginate(9);
        return view('home',compact('users'));
    }
}
