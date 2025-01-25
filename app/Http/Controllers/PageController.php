<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function getProfilePage()
    {
        $user = Auth::user();
        $posts = Post::query()
            ->where('userid', $user->id)
            ->join('users', 'posts.userid', '=', 'users.id')
            ->select('posts.*', 'users.*' , 'posts.id as post_id')
            ->get();
        return view('pages.profile', ['user' => $user, 'posts' => $posts]);
    }

    public function showSearchPage($catId = null)
    {
        $categories = Category::all();
        if ($catId) {
            $posts = Post::query()
                ->where('categoryid', $catId)
                ->join('users', 'posts.userid', '=', 'users.id')
                ->select('posts.*', 'users.*' , 'posts.id as post_id')
                ->get();
        } else {
            $posts = Post::query()
                ->join('users', 'posts.userid', '=', 'users.id')
                ->select('posts.*', 'users.*' , 'posts.id as post_id')
                ->get();
        }
        return view('pages.home', ['categories' => $categories, 'posts' => $posts]);
    }

    public function getLoginPage()
    {
        return view('pages.login');
    }
    public function getSignInPage()
    {
        return view('pages.register');
    }
    public function getEditProfile()
    {
        $user = Auth::user();
        return view('pages.profileedit' , ['user' => $user]);
    }
}
