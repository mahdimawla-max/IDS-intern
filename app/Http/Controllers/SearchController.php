<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\search;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showSearchPage()
    {
        $categories = Category::all(); 
        return view('pages.home', compact('categories')); 
    }
}

