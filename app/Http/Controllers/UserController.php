<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::with('roles')->get(),
            'roles' => Role::all(), // Pass roles to the frontend
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'role' => 'required', // Ensure a valid role is selected
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate the profile picture
        ]);

        $user = User::create($validated);
        $user->assignRole($request->role); // Assign the selected role to the user

        // If a profile picture is uploaded, store it using Media Library
        if ($request->hasFile('profile_picture')) {
            $user->addMediaFromRequest('profile_picture')
                ->toMediaCollection('profile_pictures'); // 'profile_pictures' is the collection name
        }

        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,id', // Ensure a valid role is selected
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate the profile picture
            'password' => 'nullable|string|min:6', // Make password optional, but validate if provided
        ]);

        // Update basic user details
        $user->update($validated);
        $user->syncRoles($request->role); // Update the user's role

        // If a new password is provided, update it
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Encrypt the password
            $user->save(); // Save the password change
        }

        // If a new profile picture is uploaded, update it
        if ($request->hasFile('profile_picture')) {
            // Clear old profile picture (optional, you may want to keep it)
            if ($user->hasMedia('profile_pictures')) {
                $user->getMedia('profile_pictures')->first()->delete(); // Delete the old profile picture
            }

            // Add the new profile picture
            $user->addMediaFromRequest('profile_picture')
                ->toMediaCollection('profile_pictures');
        }

        return redirect()->back()->with('success', 'User updated successfully.');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
