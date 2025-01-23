<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\search;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showSearchPage($catId = null)
    {
        $categories = Category::all();
        if ($catId) {
            $posts = Post::query()
                ->where('categoryid', $catId)
                ->get();
        } else {
            $posts = Post::all();
        }
        return view('pages.home', ['categories' => $categories , 'posts' => $posts]);
    }
}

