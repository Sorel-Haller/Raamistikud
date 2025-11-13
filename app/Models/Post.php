<?php

// Define the namespace for the model, which helps with autoloading and organizing your classes
namespace App\Models;

// Import necessary classes from Laravel
use Illuminate\Database\Eloquent\Casts\Attribute; // Used for custom attribute casting (like formatting dates)
use Illuminate\Database\Eloquent\Factories\HasFactory; // Allows using model factories for testing and seeding
use Illuminate\Database\Eloquent\Model; // Base Eloquent model class

// Define the Post model, which represents the 'posts' table in the database
class Post extends Model
{
    // Include the HasFactory trait so we can use factories with this model
    use HasFactory;
    
    // $fillable defines which attributes can be mass assigned (helps prevent mass assignment vulnerabilities)
    protected $fillable = [
        'title',      // The title of the post
        'content',    // The body/content of the post
        'author',     // The author of the post
        'published',  // Boolean or date field indicating if/when the post is published
    ];

    // $appends allows us to automatically include custom attributes in model's array/JSON form
    protected $appends = [
        'created_at_formated', // Custom formatted created_at attribute
        'updated_at_formated', // Custom formatted updated_at attribute
    ];

    // Define a custom accessor for 'created_at_formated'
    protected function createdAtFormated(): Attribute
    {
        return Attribute::make(
            // The 'get' closure defines what value should be returned when accessing this attribute
            get: fn() => $this->created_at?->diffForHumans() // Uses Laravel's diffForHumans() to make the date readable (e.g., "2 hours ago")
        );
    }

    // Define a custom accessor for 'updated_at_formated'
    protected function updatedAtFormated(): Attribute
    {
        return Attribute::make(
            // The 'get' closure defines what value should be returned when accessing this attribute
            get: fn() => $this->updated_at?->diffForHumans() // Formats updated_at in a human-friendly way
        );
    }
}
