<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ["id",
    "title",
    "date",
    "description",
    "content",
    "author",
    "category",
    "user_id",
    "status",
    "created_at",
    "updated_at"];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'blogs_tags');
    }
}

