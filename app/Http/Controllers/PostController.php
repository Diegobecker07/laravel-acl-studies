<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read_post')->only('index', 'show');
        $this->middleware('can:create_post')->only('create', 'store');
        $this->middleware('can:edit_post')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('Author')->when(auth()->user()->hasRole('Author'), function ($query){
            return $query->where('user_id', auth()->user()->id);
        })->paginate(10);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);
        $fileName = $data['title']. '.' .$data['image']->extension();

        $data['image'] = $data['image']->storeAs('posts', $fileName, 'public');
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['title'], '-');

        Post::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        Post::findOrFail($post->id);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'sometimes',
            'content' => 'sometimes',
            'status' => 'sometimes',
        ]);
        $data['slug'] = Str::slug($data['title'], '-');

        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        if($request->hasFile('image')){
            $fileName = $data['title']. '.' .$data['image']->extension();
            Storage::delete(storage_path('app/public/'.$post->image));
            $data['image'] = $data['image']->storeAs('posts', $fileName, 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        Storage::delete(storage_path('app/public/'.$post->image));
        $post->delete();
        return redirect()->route('posts.index');
    }
}
