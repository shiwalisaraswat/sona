<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Importing BaseController

use App\Http\Requests\Admin\ServiceRequest;
use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = Service::withTrashed();

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.services.index', ['records'=>$records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $record = new Service;
        return view('admin.services.create', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $validated = $request->validated();

        $service = new Service();
        $service->fill($validated);
        $service->save();

        return redirect()->route('admin.services.index')->with(['success'=>'Service added successfully.']);
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
        $record = Service::findOrFail($id);
        return view('admin.services.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, $id)
    {
		$service = Service::findOrFail($id);
        $validated = $request->validated();

		$service->fill($validated);
        $service->save();

        return redirect()->route('admin.services.index')->with(['success'=>'Service updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Service::findOrFail($id);
        
        if($record->delete()){
            return response()->json([
                'success' => true,
                'message' => 'Service moved to trash!'
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
        $record = Service::withTrashed()->findOrFail($id);
        if($record->restore()){
            return response()->json([
                'success' => true,
                'message' => 'Service restored!'
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
        $record = Service::withTrashed()->findOrFail($id);

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
        $record = Service::findOrFail($id);
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
