<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cardcontroller extends Controller
{
    public function index(){
        return view(view:'website.card.index');
    }
}
