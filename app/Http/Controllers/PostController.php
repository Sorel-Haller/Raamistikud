<?php

// Define the namespace for the controller
namespace App\Http\Controllers;

// Import necessary classes
use App\Models\Post; // The Post model representing posts table
use Illuminate\Http\Request; // Handles HTTP requests
use Inertia\Inertia; // For rendering frontend pages with Inertia.js

use function Post\Laravel\post; // ❌ This import seems incorrect. You probably meant to use the Post model, not Pest testing helper

// Define the PostController class
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch paginated posts (10 per page) and send them to the Inertia frontend page 'posts/Index'
        return Inertia::render('posts/Index', [
            'posts' => Post::with('author_id,first_name,last_name')->paginate(30),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        // Render the 'posts/Create' page where users can fill in a form
        return Inertia::render('posts/Create');
=======
        return Inertia::render('posts/Create', [
             'authors' => (Author::all()->mapWithKeys(fn($author) => [$author->id => $authir->first_name.' '.$author->last_name]))
        ]);
>>>>>>> 7d26c01 (muutused +added select)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ❌ Mistake: Using 'post' (lowercase) from Pest testing helper instead of Post model
        // Validate incoming request data, then create a new post in the database
        Post::create($request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published' => 'boolean',
        ]));

        // Redirect to the posts listing page after creation
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Currently empty. Normally, you would show details of a single post
        // Example:
        // return Inertia::render('posts/Show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Render the 'posts/Edit' page for the specific post
        return Inertia::render('posts/Edit', [
            'post' => $post // You need to pass the post data to edit form
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // ❌ Mistake: Using post::edit(). There is no 'edit' method in Eloquent. You should use $post->update()
        $post->update($request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published' => 'boolean',
        ]));

        // Redirect to the posts listing page after updating
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete the post from the database
        $post->delete();

        // Redirect back to posts list after deletion
        return redirect()->route('posts.index');
    }
}
