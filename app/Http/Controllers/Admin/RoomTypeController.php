<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Importing BaseController

use App\Http\Requests\Admin\RoomTypeRequest;
use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, RoomType $roomType)
    {
        $records = $roomType->withTrashed();
        // ->sortable(['id' => 'desc']);
        // onlyTrashed()

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.room_types.index', ['records'=>$records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $record = new RoomType;
        return view('admin.room_types.create', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomTypeRequest $request)
    {
        $validated = $request->validated();

        $roomType = RoomType::create(
            array(
                'name'        =>   $validated['name'],
                'description' =>   $validated['description'],
                'status'      =>   $validated['status'],
            )
        );
        return redirect()->route('admin.room_types.index')->with(['success'=>'RoomType added successfully.']);
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
        $record = RoomType::findOrFail($id);
        return view('admin.room_types.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomTypeRequest $request, $id)
    {
		$roomType = RoomType::findOrFail($id);
        $validated = $request->validated();

		$roomType->name        = $validated['name'];
		$roomType->description = $validated['description'];
        $roomType->status      = $validated['status'];
		$roomType->save();

        return redirect()->route('admin.room_types.index')->with(['success'=>'RoomType updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = RoomType::findOrFail($id);
        
        if($record->delete()){
            // return back()->with(['success'=>'RoomType deleted successfully.']);
            return response()->json([
                'success' => true,
                'message' => 'RoomType moved to trash!'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to delete this record.'
            ]);
            // return back()->with(['error'=>'Unable to delete this record.']);
        }
    }

    // Optional: Restore
    public function restore(string $id)
    {
        // Add withTrashed() so Laravel can "see" the deleted record
        $record = RoomType::withTrashed()->findOrFail($id);
        if($record->restore()){
            return response()->json([
                'success' => true,
                'message' => 'RoomType restored!'
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
        $record = RoomType::withTrashed()->findOrFail($id);

        // $record->forceDelete(); // This removes it from DB forever

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
        $record = RoomType::findOrFail($id);
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
