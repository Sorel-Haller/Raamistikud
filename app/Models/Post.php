<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author',
        'published',
    ];


    protected $appends =[
        'created_at_formated',
        'updated_at_formated',
    ];

    public function getExcerptAttribute()
    {
        return Attribute::make(
            get: fn() =>$this->created_at?->diffForHumans()
        );
    }

    public function updatedAtFormated ()
    {
        return Attribute::make(
            get: fn() =>$this->updated_at?->diffForHumans()
        );
    }

}
