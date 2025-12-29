<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\ApartmentSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@cairokey.com',
            'password' => Hash::make('admin@cairokey.com'),
        ]);
        // $this->call([
        //     ApartmentSeeder::class,
        //     CarSeeder::class,
        //     HotelSeeder::class,
        //     ServiceSeeder::class,
        //     OfferSeeder::class,
        // ]);
    }
}
