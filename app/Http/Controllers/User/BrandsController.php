<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    public function index()
    {
        return view('brand.index');
    }
}
