<?php

namespace App\Models;

use Illuminate\Database\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
