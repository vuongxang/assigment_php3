<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        $user_lst = [
            [
                'name' => 'administrator',
                'email' => 'vuongxang@gmail.com',
                'is_admin'=>1,
                'password' => Hash::make('123123123')
            ],
            [
                'name' => 'member',
                'email' => 'vuongxang01@gmail.com',
                'is_admin'=>1,
                'password' => Hash::make('123123123')
            ]
        ];

        foreach($user_lst as $item){
            $model = new User();
            $model->fill($item);
            $model->save();
        }
    }
}
