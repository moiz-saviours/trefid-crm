<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Team;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_contacts = Client::whereIn('brand_key', Auth::user()->teams()->with('brands')->get()->pluck('brands.*.brand_key')->flatten())->get();
        $my_contacts = $all_contacts->filter(function ($contact) {
            return $contact->loggable_type === get_class(Auth::user()) && $contact->loggable_id === Auth::id();

        });
        return view('user.contacts.index', compact('all_contacts', 'my_contacts'));
    }

}
