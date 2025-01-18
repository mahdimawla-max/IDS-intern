<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPosts(){
        $posts = Post::all();
        return $posts;
    }
    public function create(Request $request){
        $post = Post::create($request->all());
        return "post created";
    }
    public function update(Request $request, $id){
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return"post updated";
    }
    public function delete($request, $id){
        $post = Post::findOrFail($id);
        $post->delete();
        return "post deleted";
    }
    public function show($id){
        $post = Post::findOrFail($id);
        return $post;
    }
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         
        ]);
        $imageName1 = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('images'), $imageName1);
        $post=new Post();
        $category = new Category();
        $category->title = $request->title;
        $user=Auth::user();
        $post->content ='images/' . $imageName1;
        $post->category_id = $category->id;
        $post->user_id = $user->id;
        $post->description = $request->description;
        $post->save();
        
        return back()->with('success', 'Post created successfully!');
    }

    public function uploadPhoto(Request $request)
    {
        // Validate the request
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the photo in the 'uploads' directory within 'public/storage'
        $photoPath = $request->file('photo')->store('uploads', 'public');

        // Return the file path as a JSON response
        return response()->json(['photoPath' => asset('storage/' . $photoPath)]);
    }
}


