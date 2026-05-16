<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MyCommerceController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('website.home.index', compact('categories'));
    }
    public function category(){
        
        return view(view:'website.category.index');
    }
    public function detail(){
        return view(view:'website.detail.index');
    }
}
