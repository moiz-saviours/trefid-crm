<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class Cooldown
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('get') || $request->is('login') || $request->is('admin/login') || $request->is('api/login') || $request->is('developer/login')) {
            return $next($request);
        }
        $userClass = Auth::check() ? get_class(Auth::user()) : 'guest';
        $userId = Auth::check() ? Auth::id() : $request->ip();
        $cooldownKey = "cooldown:{$userClass}:{$userId}";
        $currentDurationKey = "cooldown_duration:{$userClass}:{$userId}";
        $durations = config('cache.durations');
        $route = match (true) {
            request()->is('admin/login') => 'admin.login',
            request()->is('login') => 'login',
            request()->is('api/login') => 'api.login',
            request()->is('developer/login') => 'developer.login',
            default => route('login'),
        };
        if ($request->has('crsf_token') && !empty($request->input('crsf_token'))) {
            $currentDuration = Cache::get($currentDurationKey, $durations['short_lived']);
            $nextDuration = ($currentDuration * 2) + $durations['short_lived'];
            /** Set the next cooldown period */
            Cache::put($cooldownKey, now()->addSeconds($nextDuration)->timestamp, $nextDuration);
            Cache::put($currentDurationKey, $nextDuration);
            $remainingTimeReadable = Carbon::now()->addSeconds($nextDuration)->diffForHumans(['parts' => 2, 'join' => true,]);
            $errorMessage = "Harmful behaviour detected. Cooldown set to $remainingTimeReadable.";
            if ($request->ajax()) {
                return response()->json(['error' => $errorMessage], 403);
            } else {
                if (Auth::check()) {
                    return redirect()->back()->with('error', $errorMessage);
                }
                return redirect()->route($route)->with('error', $errorMessage);
            }
        }
        /** Check if user is on cooldown */
        if (Cache::has($cooldownKey)) {
            $remainingTime = Cache::get($cooldownKey) - now()->timestamp;
            $remainingTimeReadable = Carbon::now()->addSeconds($remainingTime)->diffForHumans(['parts' => 2, 'join' => true,]);
            if ($request->ajax()) {
                return response()->json(['error' => "Harmful behaviour detected. Cooldown activated. Please wait $remainingTimeReadable."], 403);
            } else {
                if (Auth::check()) {
                    return redirect()->back()->with('error', "Harmful behaviour detected. Cooldown activated. Please wait $remainingTimeReadable.");
                }
                return redirect()->route($route)->with('error', "Harmful behaviour detected. Cooldown activated. Please wait $remainingTimeReadable.");
            }
        }
        return $next($request);
    }
}
