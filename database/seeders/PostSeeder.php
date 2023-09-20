<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $posts = [
            [
                'title' => 'My first post',
                'sub_title' => 'first post',
                'body' => 'This is the body of my first post',
                'slug' => 'my-first-post',
                // 'image' => 'https://via.placeholder.com/640x480.png/00ff77?text=My+first+post',
                'is_published' => true,
                'published_at' => now(),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'My second post',
                'sub_title' => 'second post',
                'body' => 'This is the body of my second post',
                'slug' => 'my-second-post',
                // 'image' => 'https://via.placeholder.com/640x480.png/00ff77?text=My+second+post',
                'is_published' => true,
                'published_at' => now(),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        Post::insert($posts);
    }
}
