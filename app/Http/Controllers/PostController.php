<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
    * Post一覧を表示する
    * 
    * @param Post Postモデル
     * @return array Postモデルリスト
    */
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);//$postの中身を戻り値にする。
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }
    
    public function create()
    {
        return view('posts.create');
    }
    
    // $request = post => ['title' => 'aaa', 'body' => 'aiueo']
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post']; // $input = ['title' => 'aaa', 'body' => 'aiueo']
        $post->fill($input)->save(); // 空のpostインスタンスに取得した内容を入れて保存，$post->create($input);でも可
        return redirect('/posts/'.$post->id); // 例えば/posts/5などにリダイレクト
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        
        return redirect('/posts/'.$post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
