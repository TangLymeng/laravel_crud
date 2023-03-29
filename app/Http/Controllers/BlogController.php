<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyword = request()->get('search');
        $perPage = 5;

        if(!empty($keyword)) {
            $blogs = Blog::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('category', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $blogs = Blog::latest()->paginate($perPage);
        }
        return view('blogs.index', ['blogs' => $blogs])->with('i', (request()->input('page', 1) - 1) * $perPage);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blog = new Blog();

        $request -> validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
        ]);

        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->image = $file_name;
        $blog->category = $request->category;

        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', ['blog' => $blog]);
    }

    public function update(Request $request, Blog $blog)
    {
        $request -> validate([
            'title' => 'required'
        ]);

        $file_name = $request->hidden_blog_image;
        if ( $request->image != '' ) {
            $request -> validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $file_name);
        }
        $blog = Blog::find($request->hidden_id);

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->image = $file_name;
        $blog->category = $request->category;

        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Post updated successfully.');
    }
}
