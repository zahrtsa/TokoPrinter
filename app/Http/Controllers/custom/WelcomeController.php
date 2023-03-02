<?php

namespace App\Http\Controllers\custom;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('welcome', compact(['product']));
    }
}
