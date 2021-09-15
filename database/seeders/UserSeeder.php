<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
               'first_name'=>'Nasir',
               'last_name'=>'Munda',
               'email'=>'admin@gmail.com',
               'phone'=>'9999999999',
               'role'=>'admin',
               'password'=> bcrypt('nasir'),
               'avatar'=> "https://dummyimage.com/100",
            ],
            [
                'first_name'=>'John',
                'last_name'=>'Diesel',
                'email'=>'educator@gmail.com',
                'phone'=>'9999999999',
                'role'=>'educator',
                'password'=> bcrypt('john'),
                'avatar'=> "https://dummyimage.com/100",
            ],
            [
                'first_name'=>'Bruce',
                'last_name'=>'Force',
                'email'=>'bruce@gmail.com',
                'phone'=>'9999999999',
                'role'=>'student',
                'password'=> bcrypt('bruce'),
                'avatar'=> "https://dummyimage.com/100",
            ],
        ];
  
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
