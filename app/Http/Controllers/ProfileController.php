<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        // Validate the entire request, including the file validation
        $validatedData = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add any other fields you need to validate here
        ]);

        if ($request->hasFile('profile_picture')) {
            // Check if the file is correctly uploaded
            $uploadedFile = $request->file('profile_picture');

            // Delete old photo if it exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store the new photo
            $path = $uploadedFile->store('profile_picture', 'public');
            $user->profile_picture = $path; // Save the new file path to the database
        }

        // Fill other user data from validated input, excluding profile_picture field
        $user->fill($request->except(['profile_picture']));

        // Reset email verification if the email has changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the updated user data
        $user->save();

        // Redirect with a success status
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete profile picture if exists when deleting account
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
