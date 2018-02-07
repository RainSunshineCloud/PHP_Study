<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//填充数据方法1；
        DB::table('users')->insert([

        	'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        //填充数据方法2：
        factory('App/users',50)->create()->each(function($u)
        	{
        		$u->posts()->save(factory('App/post')->make());
        	});
    }
}
