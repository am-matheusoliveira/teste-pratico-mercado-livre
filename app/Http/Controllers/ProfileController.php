<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Update the user's photo.
     */
    public function updatePhoto(Request $request): RedirectResponse
    {   
        $request->validateWithBag('updatePhoto', [
            'picture' => ['nullable', 'file', 'mimes:jpg,png,gif', 'max:3072'],
        ]);
        
        // Caso esteja removendo a imagem
        if ($request->boolean('remove_picture')) {
            $request->user()->update([
                'profile_photo_path' => null
            ]);
        }
        
        // Caso esteja carregando uma nova imagem
        elseif ($request->hasFile('picture')) {
            $path = $request->file('picture')->storePublicly('images/profile', 'public');
    
            $request->user()->update([
                'profile_photo_path' => $path
            ]);
        }
        
        return Redirect::route('profile.edit')->with('status', 'profile-photo-updated');
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

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
