<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class  PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = "posts form in PostController";
        return view('posts.index', ['posts' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();

        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $file_name;
        $post->category = $request->category;

        $post->save();
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
}
