<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $brands = Brand::all();

        return view('user.brand.index' , compact('brands'));
    }
}
