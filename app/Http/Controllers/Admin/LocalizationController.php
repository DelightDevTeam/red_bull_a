<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function setLang($locale){
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
