<?php

namespace App\Http\Controllers\Developer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use function event;
use function redirect;
use function view;

class RegisteredDeveloperController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('developer.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Developer::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $developer = Developer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($developer));

        Auth::guard('developer')->login($developer);

        return redirect(route('developer.dashboard', absolute: false));
    }
}
