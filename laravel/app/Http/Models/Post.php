<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	// protected $dates = ['created_at'];

   	protected $casts = [
   		'created_at' => 'real',
   	];
}
