<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function saveSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'settings' => 'required|array',
        ]);
        $user->settings = $request->settings;
        $user->save();
        return response()->json(['message' => 'Settings saved successfully!']);
    }
}
