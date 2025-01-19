<!-- routes/web.php -->
<?php

use App\Http\Controllers\paymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\FriendController;
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/locale/{lang}',[LocaleController::class,'setLocale']);

// Route::post('/verifyPayment',[paymentController::class]);

Auth::routes();
Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/verifyPayment',[paymentController::class,'checkPayment']);//masukan ke checkpayment valuenya

    //friends
    Route::post('/add-friend/{id}', [FriendController::class, 'addFriend'])->name('friends.add');
    Route::post('/remove-friend/{id}', [FriendController::class, 'removeFriend'])->name('friends.remove');
    Route::get('/view-friends', [FriendController::class, 'viewFriends'])->name('friends.list');
});
