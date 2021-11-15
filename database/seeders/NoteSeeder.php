<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->insert([
            'text' => "I am a super Coder",
            'author_id' => 1
        ]);
        DB::table('notes')->insert([
            'text' => "HAHAHHA",
            'author_id' => 2
        ]);
        DB::table('notes')->insert([
            'text' => "Hello World",
            'author_id' => 2
        ]);
        DB::table('notes')->insert([
            'text' => "COCO",
            'author_id' => 2
        ]);
    }
}
