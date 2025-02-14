<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teams = $user->teams()->with('brands')->get();
        return view('user.brands.index', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'nullable|url',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email',
            'description' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1',
        ]);
        try {
            $brand = new Brand($request->only(['name', 'url', 'email', 'description', 'status']));

            if ($request->hasFile('logo')) {
                $originalFileName = time() . '_' . $request->file('logo')->getClientOriginalName();
                $publicPath = public_path('assets/images/brand-logos');
                $request->file('logo')->move($publicPath, $originalFileName);
                $brand->logo = $originalFileName;
            } else if ($request->logo_url) {
                $brand->logo = $request->logo_url;
            }
            $brand->save();
//            $brand->update(['brand_key' => $brand->generateBrandKey($brand->id)]);
            return response()->json(['data' => $brand, 'message' => 'Record created successfully.']);

        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }

    public function edit(Request $request, Brand $brand)
    {
        if ($request->ajax()) {
            return response()->json($brand);
        }
        session(['edit_brand' => $brand]);
        return response()->json(['data' => $brand]);
//        return redirect()->route('user.brand.index');
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'nullable|url',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_url' => 'nullable|url',
            'email' => 'nullable|email',
            'description' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1',
        ]);
        try {
            $brand->fill($request->only(['name', 'email', 'description', 'status', 'url']));

            if ($request->hasFile('logo')) {
                $originalFileName = time() . '_' . $request->file('logo')->getClientOriginalName();
                $publicPath = public_path('assets/images/brand-logos');
                $request->file('logo')->move($publicPath, $originalFileName);
                $brand->logo = $originalFileName;
            } else if ($request->logo_url) {
                $brand->logo = $request->logo_url;
            }
            $brand->save();
            return response()->json(['data' => $brand, 'message' => 'Record updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }
}
