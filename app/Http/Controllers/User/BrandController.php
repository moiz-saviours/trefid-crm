<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Cache::remember('brands_list', config('cache.durations.short_lived'), fn() => Brand::all());
        return view('brands.index', compact('brands'));
    }
}
