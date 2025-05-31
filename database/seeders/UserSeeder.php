<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'phone_number' => '+85500000000',
                'role' => 'user',
                'password' => '$2y$12$uPJ8N4d9O.sX1PyJcoM2UesZ1Sc5rDoRMuA79.CmsMhQ6Y1xm2oSW' //password
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone_number' => '+85511111111',
                'role' => 'admin',
                'password' => '$2y$12$uPJ8N4d9O.sX1PyJcoM2UesZ1Sc5rDoRMuA79.CmsMhQ6Y1xm2oSW' //password
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@gmail.com',
                'phone_number' => '+82552222222',
                'role' => 'staff',
                'password' => '$2y$12$uPJ8N4d9O.sX1PyJcoM2UesZ1Sc5rDoRMuA79.CmsMhQ6Y1xm2oSW' //password
            ]
        ]);
    }
}
