<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BookCategory;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // User::factory(10)->create();
        $faker = Faker::create('id_ID');
        for ($i=1; $i <= 20; $i++) { 
            User::insert([
                'name'=>$faker->name,
                'email'=>$faker->unique()->safeEmail(),
                'no_hp'=>$faker->numerify('##########'),
                'alamat'=>$faker->address,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };
        BookCategory::factory(5)->create();
        // $this->call([
        //     BookCategorySeeder::class
        // ]);
    }
}
