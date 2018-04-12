<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Artical extends Model
{
    protected $table = 'articals';

    
    public static function getArticalByUid (array $field,$uid)
    {
    	self::select($field)->where($uid,$id)
    						->where('isdel','=',1)
    						->get();
    }
}







