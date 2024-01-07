<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\isAdmin;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'author' => 'required',

        ]);

        Blog::create($data);
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        
        $blog = Blog::find($blog->id);
        return view('blogs.edit')->with('blogs', $blog);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'author' => 'required',

        ]);

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->content = $request->content;
        $blog->author = $request->author;
        $blog->save();

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return back();
    }

    public function search(){
        $search_txt = $_GET['query'];
        $blogs = Blog::where('Title','LIKE', '%'.$search_txt. '%')
            ->orWhere('author','LIKE', '%'.$search_txt. '%')->get();

        return view('blogs.search', compact('blogs'));

    }

    public function filter(Request $request){

        $filter = $request->query('filter');
        $blogs = Blog::where('category', 'LIKE', '%' . $filter. '%')->get();
        return view('blogs.filter', compact('blogs'));
    }
}
