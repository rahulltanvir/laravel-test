<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyCommerceController extends Controller
{
    public function index(){
        return view(view:'website.home.index');
    }
    public function category(){
        return view(view:'website.category.index');
    }
    public function detail(){
        return view(view:'website.detail.index');
    }
}
