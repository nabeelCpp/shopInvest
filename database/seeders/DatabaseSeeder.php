<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'ShopInvest Admin',
            'email' => 'admin@shopinvest.com',
            'password' => '$2a$12$zOyHtavWXXTDhAV.aYf7ouFhWa4fBb2WBLeBWVmaVvvd4k1ytkHG2' //shopinvest123
        ]);
    }
}
