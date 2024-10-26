<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyStock;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }
}
