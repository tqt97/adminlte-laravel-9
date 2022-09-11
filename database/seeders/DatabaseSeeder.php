<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Tuantq',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12341234'),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $name = 'Root Category' . ' ' . $i;
            $slug = Str::slug($name);
            Category::factory()->create(
                [
                    'name' => $name,
                    'slug' => $slug,
                    'image' => 'default.svg',
                    'order_at' => rand(1, 10),
                    'parent_id' => null,
                    'publish' => rand(0, 1),
                    'feature' => rand(0, 1),
                ]
            );
        }

        Category::factory(5)->create();

        for ($i = 1; $i <= 5; $i++) {
            $n = Str::random(10);
            $s = Str::slug($n);
            Category::factory()->create(
                [
                    'name' => $n,
                    'slug' => $s,
                    'image' => 'default.svg',
                    'order_at' => rand(1, 10),
                    'parent_id' => rand(10, 15),
                    'publish' => rand(0, 1),
                    'feature' => rand(0, 1),
                ]
            );
        }


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
