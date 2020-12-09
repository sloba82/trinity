<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all of the Post's comments.
     */
    public function comments()
    {
        return $this->commentsStatus()->with('replies');
    }

    public function commentsStatus()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('status' , 1);
    }

    public function commentsAll()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
