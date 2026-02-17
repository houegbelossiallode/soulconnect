<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        if ($request->hasFile('profile_photo')) {
            // Delete old photo
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $photo = $request->file('profile_photo');
            $path = $photo->getRealPath();
            
            // Professional Square Cropping using GD
            $imageInfo = getimagesize($path);
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $mime = $imageInfo['mime'];

            $src = match($mime) {
                'image/jpeg' => imagecreatefromjpeg($path),
                'image/png'  => imagecreatefrompng($path),
                'image/gif'  => imagecreatefromgif($path),
                'image/webp' => imagecreatefromwebp($path),
                default      => null,
            };

            if ($src) {
                $size = min($width, $height);
                $x = ($width - $size) / 2;
                $y = ($height - $size) / 2;

                $dest = imagecreatetruecolor(600, 600);
                
                // Keep transparency for PNG/WebP
                if ($mime == 'image/png' || $mime == 'image/webp') {
                    imagealphablending($dest, false);
                    imagesavealpha($dest, true);
                    $transparent = imagecolorallocatealpha($dest, 255, 255, 255, 127);
                    imagefilledrectangle($dest, 0, 0, 600, 600, $transparent);
                }

                imagecopyresampled($dest, $src, 0, 0, $x, $y, 600, 600, $size, $size);

                $fileName = 'profile-photos/' . uniqid() . '.jpg';
                $tempPath = storage_path('app/temp_' . uniqid() . '.jpg');
                
                imagejpeg($dest, $tempPath, 90);
                Storage::disk('public')->put($fileName, File::get($tempPath));
                File::delete($tempPath);
                
                imagedestroy($src);
                imagedestroy($dest);

                $user->profile_photo_path = $fileName;
            }
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
