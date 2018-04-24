<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public  function showLoginForm ()
    {
        return view('auth/login');
    }

    public function login()
    {
        $credentials = [];
        if (Auth::once($credentials)) {

        }



    }

}
