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
	public function markComplete($id)
	{
	$contact = Contact::findOrFail($id);
	$contact->status = 'complete';
	$contact->save();

	return redirect()->back()->with('success', 'Marked as complete.');
	}
}
