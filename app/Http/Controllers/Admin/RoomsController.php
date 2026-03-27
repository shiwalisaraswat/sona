<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Importing BaseController

use App\Http\Requests\Admin\RoomRequest;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomType;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = Room::with('room_type')->withTrashed();

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->where('room_number', 'like', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.rooms.index', ['records'=>$records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $record = new Room;
        return view('admin.rooms.create', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        $validated = $request->validated();

        $room = new Room();
        $room->fill($validated);
        $room->save();

        return redirect()->route('admin.rooms.index')->with(['success'=>'Room added successfully.']);
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
        $record = Room::findOrFail($id);
        return view('admin.rooms.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, $id)
    {
		$room = Room::findOrFail($id);
        $validated = $request->validated();

		$room->fill($validated);
        $room->save();

        return redirect()->route('admin.rooms.index')->with(['success'=>'Room updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Room::findOrFail($id);
        
        if($record->delete()){
            return response()->json([
                'success' => true,
                'message' => 'Room moved to trash!'
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
        $record = Room::withTrashed()->findOrFail($id);
        if($record->restore()){
            return response()->json([
                'success' => true,
                'message' => 'Room restored!'
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
        $record = Room::withTrashed()->findOrFail($id);

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
    public function changeStatus($id)
    {
        // This logic must be modified later, booked status to be modified by frontend only
        $record = Room::findOrFail($id);

        // Status cycle logic
        $statusFlow = [
            'Available' => 'Booked',
            'Booked' => 'Maintenance',
            'Maintenance' => 'Available',
        ];

        $newStatus = $statusFlow[$record->status] ?? 'Available';

        $record->status = $newStatus;
        $record->save();

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
    }
}
