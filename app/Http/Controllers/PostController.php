<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

use App\Post;

class PostController extends Controller
{
    public function __construct() {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = \Request::query();

        if(isset($q['category_id'])) {
            $posts = Post::latest()->where('category_id', $q['category_id'])->paginate(5);
            $posts->load('category');

            $search_result = 'カテゴリ: '.$posts[0]['category']['category_name'];

            return view('posts.index', [
                'posts' => $posts,
                'search_result'  => $search_result
            ]);


        } else {
            $posts = Post::latest()->paginate(5);

            $posts->load('category');
            return view('posts.index', [
                'posts' => $posts
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post;
        $input = $request->only($post->getFillable());

        $post = $post->create($input);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load('comments.user');

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $posts = Post::where('content', 'like', "%{$request->search}%")
                    ->orWhere('title', 'like', "%{$request->search}%")
                    ->paginate(5);

        if(count($posts) != 0 ) {
            $search_result = $request->search.'の検索結果'.count($posts).'件';
            $search_flag = true;

            return view('posts.index', [
                'posts' => $posts,
                'search_flag' => $search_flag,
                'search_result'  => $search_result
            ]);

        } else {
            $search_result = $request->search.'の検索結果一件も見つかりませんでした';
            $search_flag = false;

            return view('posts.index', [
                'posts' => $posts,
                'search_flag' => $search_flag,
                'search_result'  => $search_result
            ]);
        }

    }
}
