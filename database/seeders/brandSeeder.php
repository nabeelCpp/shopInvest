<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class brandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            ['id' => 2,'name' => 'Nike'],
            ['id' => 9,'name' => 'Puma'],
            ['id' => 10,'name' => 'Adidas'],
            ['id' => 11,'name' => 'Denim'],
            ['id' => 12,'name' => 'D&G'],
            ['id' => 13,'name' => 'MRF']
        ];
        \App\Models\Brand::create($brands);
    }
}
