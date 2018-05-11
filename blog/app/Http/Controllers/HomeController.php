<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\EmailToCustomer;
use App\Http\Models\User;

use Notification;

class HomeController extends Controller
{
    use HasRoles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();
        $user->name='sdf';
        $user->email='212232asd';
        $user->password=bcrypt(123);
        $user->save();
//        Notification::route('pusher', ['my-chennel','my-event'])->notify(new \App\Notifications\PusherToCustomer());

        return 111;
    }
}
