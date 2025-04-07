<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('user_type', 'user')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
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

        User::create($data);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'business_proof' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'identity_proof' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $data = $request->only(['name', 'email']);

        if ($request->hasFile('business_proof')) {
            Storage::delete($user->business_proof);
            $data['business_proof'] = $request->file('business_proof')->store('identifications');
        }
        if ($request->hasFile('identity_proof')) {
            Storage::delete($user->identity_proof);
            $data['identity_proof'] = $request->file('identity_proof')->store('identifications');
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        Storage::delete([$user->business_proof, $user->identity_proof]);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
