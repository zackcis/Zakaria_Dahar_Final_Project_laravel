<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['image', 'max:2048'], // Ensure the uploaded file is an image (jpg, png, etc.) and within 2MB
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile-images', 'public');
        } else {
            // If no image is uploaded, use a default image or set the image path to null
            $imagePath = null;
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath, // Save the image path to the database
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
    public function updateImage(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['image', 'max:2048'], // Ensure the uploaded file is an image (jpg, png, etc.) and within 2MB
        ]);

        $user = Auth::user();

        // Delete the existing image if it exists
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $imagePath = $this->storeImage($request->file('image'));

        $user->update(['image' => $imagePath]);

        return redirect()->back()->with('success', 'Image updated successfully.');
    }

    /**
     * Delete the user's image.
     */
    public function deleteImage(): RedirectResponse
    {
        $user = Auth::user();

        // Delete the existing image if it exists
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
            $user->update(['image' => null]);
        }

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    /**
     * Store the uploaded image and return its path.
     */
    private function storeImage($image): string
    {
        return $image ? $image->store('profile-images', 'public') : null;
    }
}
