<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@stickitownit.com',
            'password' => Hash::make('admin123'),
            'status' => 'active',
            'user_type' => 'super-admin',
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'An Admin',
            'email' => 'anotheradmin@stickitownit.com',
            'password' => Hash::make('admin123'),
            'status' => 'active',
            'user_type' => 'admin',
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'An Customer',
            'email' => 'customer@stickitownit.com',
            'password' => Hash::make('customer123'),
            'status' => 'active',
            'user_type' => 'customer',
            'created_at' => Carbon::now(),
        ]);

        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
