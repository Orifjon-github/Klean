<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'user_id' => 1,
            'title' => 'Sarlavha',
            'shorts_content' => 'qizsqa conten seeder',
            'content' => 'maqola',
            'photo' => null,
        ]);
        Post::create([
            'user_id' => 1,
            'title' => 'Sarlavha',
            'shorts_content' => 'qizsqa conten seeder',
            'content' => 'maqola',
            'photo' => null,
        ]);
    }
}
