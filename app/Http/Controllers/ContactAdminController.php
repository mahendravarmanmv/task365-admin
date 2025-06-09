<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get(); // Pagination
        return view('contacts.index', compact('contacts'));
    }
}
