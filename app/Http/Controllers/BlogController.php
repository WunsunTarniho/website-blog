<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest();

        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%');
        }

        return view('blog', [
            'title' => 'All Blog',
            'posts' => $posts->with(['user', 'category'])->get(),
        ]);
    }

    public function myblog()
    {
        return view('blog', [
            'title' => 'My Blog',
            'posts' => Post::find(Auth::user()->id)->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create', [
            'title' => 'Create Post',
            'categories' => Category::all(),
        ]);
    }

    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:25', 'max:100'],
            'category_id' => ['required'],
            'slug' => ['required', 'min:5', 'unique:posts'],
            'body' => ['required', 'min:255'],
            'image' => ['image', 'file', 'max:1024'],
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('image-post');
        }

        $validated['user_id'] = Auth::user()->id;
        $validated['except'] = Str::limit(str_replace('&nbsp;', '', strip_tags($request->body)), 300, '...');

        Post::create($validated);
        return redirect('/myblog')->with('success', 'Create post success !');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $post = Post::find($id);

        return view('post', [
            'title' => $post->title,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $user = Auth::user();

        if ($user->id !== $post->user->id && $user->role === 'user') {
            abort(403);
        }

        return view('edit', [
            'title' => 'Edit Post',
            'categories' => Category::all(),
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $rules = [
            'title' => ['required', 'min:25', 'max:100'],
            'category_id' => ['required'],
            'body' => ['required', 'min:255'],
            'image' => ['image', 'file', 'max:1024'],
        ];

        if ($request->slug !== Post::find($id)->slug) {
            $rules['slug'] = ['required', 'min:5', 'unique:posts'];
        }

        $validated = $request->validate($rules);

        $oldImg = Post::find($id)->image;

        if ($request->file('image')) {
            if ($oldImg) {
                Storage::delete($oldImg);
            }
            $validated['image'] = $request->file('image')->store('image-post');
        }

        Post::find($id)->update($validated);

        return redirect('/myblog')->with('success', 'Update post success !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $post = Post::find($id);

        if ($post->image) {
            Storage::delete($post->image);
        }
        
        Post::destroy($post);
        return redirect('/myblog')->with('success', 'Delete post success !');
    }
}
