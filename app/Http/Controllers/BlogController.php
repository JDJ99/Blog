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
        $user = Auth::user();
        
        if ($user) {
            // User is logged in
            if ($user->admins == '1') {
                // Admin can view all blogs
                $blogs = Blog::all();
            } else {
                // Regular user sees their own blogs and public blogs
                $blogs = Blog::where('user_id', $user->id)
                    ->orWhere('status', 1)
                    ->get();
            }
            $countPost = $blogs->count();
        } else {
            // Non-logged-in user can view all public blogs
            $blogs = Blog::where('status', 1)->get();
            $countPost = $blogs->count();
        }

        return view('blogs.index', compact('blogs', 'countPost'));
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
            'category' => 'required||in :Advice,News,Questions',
            'author' => 'required',
            'user_id' => 'required',
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
    
    public function changeStatus(Request $request)
    {
        try {
            $blog = Blog::findOrFail($request->id);
            $blog->status = $request->status;
            $blog->save();

            return response()->json(['success' => 'Status changed successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function search(){
        $search_txt = $_GET['query'];
        $blogs = Blog::where('Title','LIKE', '%'.$search_txt. '%')
            ->get();

        return view('blogs.search', compact('blogs'));

    }
    public function filter(Request $request){

        $filter = $request->query('filter');
        $blogs = Blog::where('category', 'LIKE', '%' . $filter. '%')->get();
        return view('blogs.filter', compact('blogs'));
    }
}
