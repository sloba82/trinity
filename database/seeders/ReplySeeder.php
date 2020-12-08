<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reply;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $replies = [
            [
                'comment_id' => 1,
                'reply' => 'News reply 1'
            ],
            [
                'comment_id' => 1,
                'reply' => 'News reply 2'
            ],
            [
                'comment_id' => 2,
                'reply' => 'Post reply 1'
            ],
            [
                'comment_id' => 2,
                'reply' => 'Post reply 2'
            ]
        ];

        Reply::insert($replies);
    }
}
