<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = User::create([
            "fname" => "Mr.",
            "lname" => "Admin",
            "email" => "admin@test.com",
            "password" => Hash::make("password"),
            "address" => "",
            "zip" => "",
            "city" => "",
            "country" => "",
        ]);
        $user1 = User::create([
            "fname" => "Test",
            "lname" => "User 1",
            "email" => "user1@test.com",
            "password" => Hash::make("password"),
            "address" => "",
            "zip" => "",
            "city" => "",
            "country" => "",
        ]);
        $user2 = User::create([
            "fname" => "Test",
            "lname" => "User 2",
            "email" => "user2@test.com",
            "password" => Hash::make("password"),
            "address" => "",
            "zip" => "",
            "city" => "",
            "country" => "",
        ]);

        $super_admin->assignRole(['name' => 'admin']);
        $user1->assignRole(['name' => 'user']);
        $user2->assignRole(['name' => 'user']);

        \DB::table('personal_access_tokens')->insert([
            [
                'tokenable_type' => User::class,
                'tokenable_id' => 1,
                'name' => 'api_token',
                'token' => 'd8ed3af9c389fc718c7e1b66b5d3f760d73a189e94a3f29671a3505361964797',
                'abilities' => '["*"]'
            ],
            [
                'tokenable_type' => User::class,
                'tokenable_id' => 2,
                'name' => 'api_token',
                'token' => 'd0a70e6404a3daf74023d58340523462e2d893af70cb95cbc97048a160eefd7f',
                'abilities' => '["*"]'
            ],
            [
                'tokenable_type' => User::class,
                'tokenable_id' => 3,
                'name' => 'api_token',
                'token' => 'd998a8f46eaf8dfcf87ce0b113591803a8cbc56ac993777db91f4bbccc0f2a9c',
                'abilities' => '["*"]'
            ],
        ]);
    }
}
