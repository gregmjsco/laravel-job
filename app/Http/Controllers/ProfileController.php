<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    //

    public function update(Request $request): RedirectResponse
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' =>
                'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update the user's information
        $user->update($validatedData);

        // Redirect back to the dashboard page with a success message
        return redirect()
            ->route('dashboard')
            ->with('success', 'User info updated successfully!');
    }
}
