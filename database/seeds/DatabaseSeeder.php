<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "JARI",
            'email' => "jarimesina1234@gmail.com",
            'password' => bcrypt('09876543'),
            'isAdmin' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => "JEM",
            'email' => "jem@gmail.com",
            'password' => bcrypt('09876543'),
            'isAdmin' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => "DAISUKE",
            'email' => "daisuke@gmail.com",
            'password' => bcrypt('09876543'),
            'isAdmin' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('categories')->insert([
            'title' => "Basic 500",
            'description' => "easy",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('categories')->insert([
            'title' => "restaurant words",
            'description' => "hard",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('questions')->insert([
            'term' => "Hai",
            'category_id' =>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('questions')->insert([
            'term' => "Abura",
            'category_id' =>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('questions')->insert([
            'term' => "Akachan",
            'category_id' =>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('questions')->insert([
            'term' => "Jusu",
            'category_id' =>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('questions')->insert([
            'term' => "Biru",
            'category_id' =>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('questions')->insert([
            'term' => "Dezatu",
            'category_id' =>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 1,
            'word' =>"yes",
            'isCorrect'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 1,
            'word' =>"no",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 1,
            'word' =>"maybe",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 1,
            'word' =>"never",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 2,
            'word' =>"oil",
            'isCorrect'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 2,
            'word' =>"water",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 2,
            'word' =>"alcohol",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 2,
            'word' =>"soda",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 3,
            'word' =>"baby",
            'isCorrect'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 3,
            'word' =>"human",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 3,
            'word' =>"son",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 3,
            'word' =>"bag",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 4,
            'word' =>"jusu",
            'isCorrect'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 4,
            'word' =>"egg",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 4,
            'word' =>"can",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 4,
            'word' =>"bottle",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 5,
            'word' =>"beer",
            'isCorrect'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 5,
            'word' =>"phone",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 5,
            'word' =>"chair",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 5,
            'word' =>"laptop",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 6,
            'word' =>"dessert",
            'isCorrect'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 6,
            'word' =>"ice cream",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 6,
            'word' =>"toy",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('choices')->insert([
            'question_id' => 6,
            'word' =>"ball",
            'isCorrect'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
