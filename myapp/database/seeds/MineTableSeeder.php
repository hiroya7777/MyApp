<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mines')->truncate();
        
        DB::table('mines')->insert([
            'name' => '山田太郎',
            'age' => 20,
        ]);

        DB::table('mines')->insert([
            'name' => '田中次郎',
            'age' => 43,
        ]);

        DB::table('mines')->insert([
            'name' => '鈴木三郎',
            'age' => 35,
        ]);

        DB::table('mines')->insert([
            'name' => '藤原四郎',
            'age' => 56,
        ]);
    }
}
