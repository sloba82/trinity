<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'name',
        'email',
        'commentable_id',
        'commentable_type',
        'type',
        'status'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function repliesAll()
    {
        return $this->hasMany(Reply::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->where('status' , 1);
    }


}
