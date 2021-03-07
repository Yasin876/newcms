<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user=User::where('email','yasincmc2017@gmail.com')->first();

       if(!$user){
           User::create([
               'name'=>'yasin',
               'email'=>'yasincmc2017@gmail.com',
               'role'=>'admin',
               'about'=>'I am admin',
               'password'=>Hash::make('root')
           ]);
       }
    }
}
