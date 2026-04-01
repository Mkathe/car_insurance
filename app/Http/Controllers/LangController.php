<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function setLocale(Request $req, $locale){
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
