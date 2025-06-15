<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::where('user_type', 'user')->get(); // Removed pagination
        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'business_proof' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'identity_proof' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $data = $request->only(['name', 'email']);
        $data['password'] = Hash::make($request->password);
        $data['user_type'] = 'user';

        if ($request->hasFile('business_proof')) {
            $data['business_proof'] = $request->file('business_proof')->store('identifications');
        }
        if ($request->hasFile('identity_proof')) {
            $data['identity_proof'] = $request->file('identity_proof')->store('identifications');
        }

        Vendor::create($data);
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully');
    }

    public function edit(Vendor $vendor)
    {
        $vendor->load('categories'); // Load categories relationship
        $categories = Category::all(); // Fetch all categories
        return view('vendors.edit', compact('vendor', 'categories'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        if (!$request->has('toggle_approval')){

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $vendor->id,
                'company_name' => 'nullable|string|max:255',
                'website' => 'nullable|string|max:255',
                'phone' => 'required|string|max:15',
                'alternative_number' => 'nullable|string|max:15',
                'business_proof' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
                'identity_proof' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
                'categories' => 'array',
                'categories.*' => 'exists:categories,id',
            ]);
        }        

        $data = $request->only(['name', 'email', 'company_name', 'website', 'phone', 'alternative_number']);

        $storagePath = '/home/u361181901/domains/task365.in/public_html/public/storage/identifications/';

        if ($request->hasFile('business_proof')) {
            if (!empty($vendor->business_proof)) {
                File::delete($storagePath . basename($vendor->business_proof));
            }
            $fileName = time() . '_business.' . $request->file('business_proof')->getClientOriginalExtension();
            $request->file('business_proof')->move($storagePath, $fileName);
            $data['business_proof'] = 'identifications/' . $fileName;
        }

        if ($request->hasFile('identity_proof')) {
            if (!empty($vendor->identity_proof)) {
                File::delete($storagePath . basename($vendor->identity_proof));
            }
            $fileName = time() . '_identity.' . $request->file('identity_proof')->getClientOriginalExtension();
            $request->file('identity_proof')->move($storagePath, $fileName);
            $data['identity_proof'] = 'identifications/' . $fileName;
        }

        if ($request->has('toggle_approval')) {
            $vendor->approved = !$vendor->approved; // Toggle approval status
            $vendor->save();
            $status = $vendor->approved ? 'Vendor approved successfully' : 'Vendor blocked successfully';
            return redirect()->route('vendors.index')->with('success', $status);
        }       

        $vendor->update($data);

        if ($request->has('categories')) {
            $vendor->categories()->sync($request->categories);
        }

        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully');
    }


    public function destroy(Vendor $vendor)
    {
        // Correct absolute path to task365.in storage folder
        $storagePath = '/home/u361181901/domains/task365.in/public_html/public/storage/';

        $businessProofPath = $storagePath . $vendor->business_proof;
        $identityProofPath = $storagePath . $vendor->identity_proof;

        // Delete business proof file
        if (!empty($vendor->business_proof) && File::exists($businessProofPath)) {
            File::delete($businessProofPath);
            Log::info('Deleted file: ' . $businessProofPath);
        } else {
            Log::warning('File not found: ' . $businessProofPath);
        }

        // Delete identity proof file
        if (!empty($vendor->identity_proof) && File::exists($identityProofPath)) {
            File::delete($identityProofPath);
            Log::info('Deleted file: ' . $identityProofPath);
        } else {
            Log::warning('File not found: ' . $identityProofPath);
        }

        // Delete vendor from database
        $vendor->delete();

        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully');
    }
}
