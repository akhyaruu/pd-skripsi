<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
   private $postService;

   public function __construct(PostService $postService)
   {
       $this->postService = $postService;
   }


   public function index()
   {
      $data = $this->postService->all();
      return view('admin.post.index', compact('data'));
   }


   public function create()
   {
      return view('admin.post.create');
   }


   public function store(Request $request)
   {
      $this->postService->store($request->all());
      return redirect()->route('post.index')->with('success','Post has success created');
   }


   public function show(Post $post)
   {
      return view('admin.post.show', compact('post'));
   }


   public function edit(Post $post)
   {
      return view('admin.post.edit', compact('post'));
   }


   public function update(Request $request, Post $post)
   {
      $this->postService->update($request->all(),$post->id);
      return redirect()->route('post.index')->with('success','Post has success updated');
   }


   public function destroy(Post $post)
   {
      $this->postService->destroy($post->id);
      return redirect()->route('post.index')->with('success','Post has success deleted');
   }
}