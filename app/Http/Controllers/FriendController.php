<?php
// app/http/controllers/friendcontroller
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function addFriend($id)
    {
        /** @var User $loggedInUser */
        $loggedInUser = Auth::user();

        $loggedInUser->addFriend($id);

        return redirect()->back()->with('success', 'Friend added successfully');
    }

    public function removeFriend($id)
    {
        /** @var User $loggedInUser */
        $loggedInUser = Auth::user();

        $loggedInUser->removeFriend($id);

        return redirect()->back()->with('success', 'Friend removed successfully');
    }
}
