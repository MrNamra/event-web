<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        DB::table('categories')->insert([
            ['event_id' => 1, 'name' => 'Technology', 'created_at' => $now, 'updated_at' => $now],
            ['event_id' => 2, 'name' => 'Business', 'created_at' => $now, 'updated_at' => $now],
            ['event_id' => 3, 'name' => 'Health', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
