<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }
}
