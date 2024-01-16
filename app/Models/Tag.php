<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function blog()
    {
        return $this->belongsToMany(Blog::class, 
        'blogs_tags',
        'blogs_id',
        'tags_id');
    }
}

