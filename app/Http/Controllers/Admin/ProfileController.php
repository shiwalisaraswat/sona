<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Importing BaseController

use App\Http\Requests\Admin\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Admin;
use File;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // return view('admin.profile.edit', [
        //     'admin' => Auth::guard('admin')->user(),
        // ]);

        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $admin = Auth::guard('admin')->user();

        // Validate normal fields
        $validated = $request->validated();

        // Handle file upload
        if ($request->hasFile('profile_pic')) {

            $file = $request->file('profile_pic');

            // Create folder if not exists
            $destinationPath = public_path(Admin::PROFILE_PIC_PATH);

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Generate unique filename
            $fileName = 'admin_' . time() . '.' . $file->getClientOriginalExtension();

            // Move file
            $file->move($destinationPath, $fileName);

            // Delete old image
            if (!empty($admin->profile_pic)) {

                $oldPath = public_path(Admin::PROFILE_PIC_PATH . '/' . $admin->profile_pic);

                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // Save new filename in DB
            $admin->profile_pic = $fileName;
        }

        // Update other fields
        $admin->name  = $validated['name'];
        $admin->email = $validated['email'];
        $admin->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the admin's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $admin = $request->admin();

        Auth::logout();

        $admin->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/admin');
    }
}
