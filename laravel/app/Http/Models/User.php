<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public static function getUserInfoById($id,$field = '*')
    {	
    	$res = self::select($field)->where('id',$id)
    					->first();
    }
}
