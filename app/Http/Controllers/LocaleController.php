<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function setLocale($lang){
        if(in_array($lang,['en','id'])){
            App::setLocale($lang);
            session(['locale'=>$lang]);
        }
        return back();
    }
}
