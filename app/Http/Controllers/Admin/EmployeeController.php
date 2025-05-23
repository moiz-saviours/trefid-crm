<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignTeamMember;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.employees.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'team_key' => 'nullable|integer|exists:teams,team_key',
            'emp_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'pseudo_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'pseudo_email' => 'nullable|email|max:255|unique:users,email',
            'designation' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string',
            'pseudo_phone' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'dob' => 'nullable|date',
            'date_of_joining' => 'nullable|date',
            'about' => 'nullable|string',
            'target' => 'nullable|integer',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|max:255',
//            'phone_number' => 'nullable|regex:/^(\+?\d{1,3})[\d\s().-]+$/|min:8|max:20'
        ]);
        try {

            $user = new User($request->only([
                'team_key', 'emp_id', 'name', 'pseudo_name', 'email', 'pseudo_email', 'designation', 'gender',
                'phone_number', 'pseudo_phone', 'address', 'city', 'state', 'country',
                'postal_code', 'dob', 'date_of_joining', 'about', 'target', 'status'
            ]));
            if ($request->hasFile('image')) {
                $originalFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $publicPath = public_path('assets/images/employees');
                $request->file('image')->move($publicPath, $originalFileName);
                $user->image = $originalFileName;
            }
            if ($request->has('password') && !empty($request->input('password'))) {
                $user->password = Hash::make($request->input('password'));
            } else {
                $user->password = Hash::make(12345678);
            }
            $user->save();
            return response()->json(['data' => $user, 'message' => 'Record created successfully.']);

        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.employees.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user)
    {
        $teams = Team::whereStatus(1)->get();
        $firstTeam = $user->teams->first();
        $user->team_key = $firstTeam ? $firstTeam->team_key : null;
        if ($request->ajax()) {
            return response()->json(['user' => $user, 'teams' => $teams]);
        }
        return view('admin.employees.edit', compact('user', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'team_key' => 'nullable|integer|exists:teams,team_key',
            'emp_id' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'pseudo_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'pseudo_email' => 'nullable|email|max:255|unique:users,email',
            'designation' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'target' => 'nullable|integer',
            'status' => 'required|in:0,1',
            'password' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string',
            'pseudo_phone' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'dob' => 'nullable|date',
            'date_of_joining' => 'nullable|date',
            'about' => 'nullable|string',
//            'phone_number' => 'nullable|regex:/^(\+?\d{1,3})[\d\s().-]+$/|min:8|max:20'
        ]);
        $user->fill($request->only([
            'team_key', 'emp_id', 'name', 'pseudo_name', 'email', 'pseudo_email', 'designation', 'gender',
            'phone_number', 'pseudo_phone', 'address', 'city', 'state', 'country',
            'postal_code', 'dob', 'date_of_joining', 'about', 'target', 'status'
        ]));
        try {

            if ($request->hasFile('image')) {

                if ($user->image) {
                    if (!filter_var($user->image, FILTER_VALIDATE_URL)) {
                        $path = public_path('assets/images/employees/' . $user->image);
                        if (File::exists($path)) {
//                        File::delete($path);
                        }
                    }
                }
                $originalFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $publicPath = public_path('assets/images/employees');
                $request->file('image')->move($publicPath, $originalFileName);
                $user->image = $originalFileName;
            }
            if ($request->has('password') && !empty($request->input('password'))) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();
            if ($request->has('team_key') && !empty($request->input('team_key'))) {
                $user->teams()->sync($request->input('team_key'));
            }
            $teamNames = $user->teams->pluck('name')->map('htmlspecialchars_decode')->implode(', ');
            return response()->json(['data' => array_merge($user->toArray(), ['team_name' => $teamNames]), 'message' => 'Record updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user)
    {
        try {
            if ($user->image) {
                if (!filter_var($user->image, FILTER_VALIDATE_URL)) {
                    $path = public_path('assets/images/employees/' . $user->image);
                    if (File::exists($path)) {
//                        File::delete($path);
                    }
                }
            }
            if ($user->delete()) {
                return response()->json(['success' => 'The record has been deleted successfully.']);
            }
            return response()->json(['error' => 'An error occurred while deleting the record.']);

        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }

    /**
     * Update password of specified resource in storage.
     */
    public function update_password(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|max:255',
        ]);
        try {
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return response()->json(['data' => $user, 'message' => 'Record password updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }

    /**
     * Change the specified resource status from storage.
     */
    public function change_status(Request $request, User $user)
    {
        try {
            if (!$user->id) {
                return response()->json(['error' => 'Record not found. Please try again later.'], 404);
            }
            $user->status = $request->query('status');
            $user->save();
            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }
}
