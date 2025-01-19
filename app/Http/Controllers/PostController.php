<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $imageName1 = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploaded'), $imageName1);

        $post = new Post();
        $category = Category::firstOrCreate(
            ['name' => $request->title],
        );

        $post->content = 'images/' . $imageName1;
        $post->categoryid = $category->id;
        $post->userid = $user->id;
        $post->description = $request->description;
        $post->save();

        return response()->json(['success' => 'Post created successfully!']);
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


