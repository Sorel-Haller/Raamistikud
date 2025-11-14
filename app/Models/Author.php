<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
    ];

    protected $appends = [
        'created_at_formated',
        'updated_at_formated',
    ];

    // Accessors for formatted timestamps
    protected function createdAtFormated(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at?->diffForHumans()
        );
    }

    protected function updatedAtFormated(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->updated_at?->diffForHumans()
        );
    }

    // Relation to posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
