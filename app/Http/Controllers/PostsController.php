<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Category;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create') -> with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        //dd($request -> image->store('posts'));
        $image = $request -> image -> store('posts');
        Post::create([
            'title' => $request -> title, 
            'description' => $request -> description,
            'content' => $request -> content,
            'image' => $image,
            'published_at' => $request -> published_at,
            'category_id' => $request -> category,
        ]);

        session() -> flash('success', 'Post created');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create') -> with('post', $post) -> with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request -> only(['title', 'description', 'published_at', 'content']);

        if($request -> hasFile('image')) {
            $image = $request -> image -> store('posts');
            $post -> deleteImage();
            $data['image'] = $image;
        }

        $post -> update($data);

        session() -> flash('success', 'Post Updated');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        $post -> delete();
        session() -> flash('success', 'Post deleted.');
        return redirect(route('posts.index'));
            above codes show softDeleted post. if you checked posts table, only one post shows. Prev softDeleted posts deleted from db?
        above refactored to hard delete below
        if($post -> trashed()){
            $post -> forceDelete();
        } else {
            $post -> delete();
        }
            //this failed = 404. Route model binding ek-ek didnt work so change destroy params from Post $post to $id, then use below
         */

        //$post = Post::withTrashed() -> where('id', $id) -> first();
        $post = Post::withTrashed() -> where('id', $id) -> firstOrFail();
        // $post->delete(); // softdelete post still in db
        if ($post->trashed()){
            $post -> deleteImage();
            $post->forceDelete();
        } else {
            $post->delete();
        }
        session() -> flash('success', 'Post was deleted.');
        return redirect(route('posts.index'));
    }

    /**
        displays a list of post in trash
        @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts', $trashed);
            //bahdcasts code different tuts vs repository...this works now.
    }

    public function restore($id)
    {
        $post = Post::withTrashed() -> where('id', $id) -> firstOrFail();
        $post -> restore();
        session() -> flash('success', 'Post restored');
        return redirect() -> back();
    }

}
