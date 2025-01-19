<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// <!-- app/http/controllers/paymentcontroller -->
class paymentController extends Controller
{
    public function checkPayment(Request $request){
            $request -> validate([
                'enteredNumber'=>'required||exists'
            ]);
    }
    public function generateRandomNumber()
    {
        $randomNumber = rand(1000, 9999);
        session(['randomNumber' => $randomNumber]);
        return $randomNumber;
    }

}
