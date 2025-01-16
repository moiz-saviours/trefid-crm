<?php

namespace App\Http\Controllers\User\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerContact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_contacts = CustomerContact::whereIn('brand_key', Auth::user()->teams()->with('brands')->get()->pluck('brands.*.brand_key')->flatten())->get();
        $my_contacts = $all_contacts->filter(function ($contact) {
            return $contact->creator_type === get_class(Auth::user()) && $contact->creator_id === Auth::id();

        });
        return view('user.customers.contacts.index', compact('all_contacts', 'my_contacts'));
    }

}
