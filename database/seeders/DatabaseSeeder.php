<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Admin::create([
            'name' => 'Shazil',
            'email' => 'shazil@redsoltechnologies.com',
            'password' => bcrypt('Allah@123'),
        ]);

        // $this->call(ProjectSeeder::class);
        // $this->call(WebsiteInformationSeeder::class);
        // $this->call(BlogPostSeeder::class);
    }
}
