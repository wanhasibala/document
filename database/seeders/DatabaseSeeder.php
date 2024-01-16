<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'=>'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(12345678),
            'is_admin' => true,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Document::factory(10)->create([
        //     'id' => Str::uuid(),
        //     'title' => Str::random(12),
        //     'file_path' => null, // You can replace null with the actual file path
        //     'category_id' =>  1,
        //     'tags' => null, // Replace with your desired tags
        // ]);
    }
    
}

