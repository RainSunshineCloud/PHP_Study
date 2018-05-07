<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class LoginController extends AdminController
{

    public function index ()
    {
        return view('admin_template');
    }
}
