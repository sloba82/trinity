<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $comments = [
           [
            'comment' => 'News some comment 1',
            'name' => 'one',
            'email' => 'one@test.com',
            'commentable_id' => 1,
            'commentable_type' => 'App\Models\News',
            'type' => 'news',
            'status' => 1,
            'created_at' => '2020-12-08',
            'updated_at' => '2020-12-08',
           ],
           [
            'comment' => 'Post some comment 2',
            'name' => 'two',
            'email' => 'two@test.com',
            'commentable_id' => 1,
            'commentable_type' => 'App\Models\Post',
            'type' => 'post',
            'status' => 1,
            'created_at' => '2020-12-08',
            'updated_at' => '2020-12-08',
           ],
           [
            'comment' => 'Post some comment 2',
            'name' => 'two',
            'email' => 'two@test.com',
            'commentable_id' => 1,
            'commentable_type' => 'App\Models\Post',
            'type' => 'post',
            'status' => 1,
            'created_at' => '2020-12-08',
            'updated_at' => '2020-12-08',
            ]
        ];

        Comment::insert($comments);
    }
}
