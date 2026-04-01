<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Importing BaseController

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use File;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = Admin::withTrashed();

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.admins.index', ['records'=>$records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $record = new Admin;
        return view('admin.admins.create', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $admin = new Admin();
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

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

            // Save new filename in DB
            $validated['profile_pic'] = $fileName;
        }

        $admin->fill($validated);
        $admin->save();

        return redirect()->route('admin.admins.index')->with(['success'=>'Admin added successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Admin::findOrFail($id);
        return view('admin.admins.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, $id)
    {
		$admin = Admin::findOrFail($id);
        $validated = $request->validated();

        $validated['password'] = (!empty($validated['password'])) ? Hash::make($validated['password']) : $admin->password;

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
            $validated['profile_pic'] = $fileName;
        }

		$admin->fill($validated);
        $admin->save();

        return redirect()->route('admin.admins.index')->with(['success'=>'Admin updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Admin::findOrFail($id);
        
        if($record->delete()){
            return response()->json([
                'success' => true,
                'message' => 'Admin moved to trash!'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to delete this record.'
            ]);
        }
    }

    // Optional: Restore
    public function restore(string $id)
    {
        // Add withTrashed() so Laravel can "see" the deleted record
        $record = Admin::withTrashed()->findOrFail($id);
        if($record->restore()){
            return response()->json([
                'success' => true,
                'message' => 'Admin restored!'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to restore this record.'
            ]);
        }
    }

    public function forceDelete(string $id)
    {
        // Use withTrashed() so you don't get a 404 if trying to delete something already in trash, 
        // withTrashed is required to find the record first!
        $record = Admin::withTrashed()->findOrFail($id);

        if($record->forceDelete()){ // This removes it from DB forever
            return response()->json([
                'success' => true,
                'message' => 'Record wiped from database!'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to wipe this record.'
            ]);
        }
    }

    /**
     * Change Status the specified resource.
     *
     */
    public function changeStatus(string $id)
    {
        $record = Admin::findOrFail($id);
        $record->status = ($record->status == 'Active') ? 'Inactive' : 'Active';
        if($record->save()){
            return response()->json([
                'success' => true,
                'new_status' => $record->status,
                'message' => 'Status changed to <strong>'.$record->status.'</strong>'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'new_status' => $record->status,
                'message' => 'Unable to change status'
            ]);
        }
        return response()->json(['error' => $error,'message' => $message]);
    }
}
