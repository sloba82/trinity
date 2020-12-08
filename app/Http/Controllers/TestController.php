<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Post;

class TestController extends Controller {

    public function index()
    {
        $news = News::findOrFail(1);

        $post = Post::findOrFail(1);

        // $news->comments()->create([
        //     'comment' => 'News  some comment 5555',
        //     'name' => 'two',
        //     'email' => 'two@test.com',
        // ]);

        return [
            'news' => $news->comments,
            'post' => $post->comments,

        ];
    }

}
