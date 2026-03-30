<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Importing BaseController

use App\Http\Requests\Admin\RoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Models\Room;
use App\Models\RoomType;


class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = Room::with(['room_type', 'room_feature', 'services', 'room_images', 'first_image'])->withTrashed();

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
        DB::beginTransaction();
        try {
            // ✅ 1. Get validated data ONLY
            $validated = $request->validated();

            // ✅ 2. Create Room (ONLY required fields)
            $room = Room::create([
                'room_type_id' => $validated['room_type_id'],
                'room_number'  => $validated['room_number'],
                'price'        => $validated['price'],
                'status'       => $validated['status'] ?? Room::AVAILABLE,
            ]);

            // ✅ 3. Save Feature (One-to-One)
            $room->room_feature()->create([
                'size'        => $validated['size'] ?? null,
                'capacity'    => $validated['capacity'] ?? null,
                'bed'         => $validated['bed'] ?? null,
                'description' => $validated['description'] ?? null,
            ]);

            // ✅ 4. Save Services (Many-to-Many)
            if (!empty($validated['services'])) {
                $room->services()->sync($validated['services']);
            }

            // ✅ 5. Save Images (One-to-Many)
            if ($request->hasFile('images')) {
                $imagesData = [];
                $destinationPath = public_path('admin/images/rooms');

                // ✅ Ensure directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                foreach ($request->file('images') as $file) {
                    // Generate unique file name
                    $fileName = 'room_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // ✅ Move file directly (NO resizing)
                    $file->move($destinationPath, $fileName);

                    $imagesData[] = [
                        'image' => $fileName
                    ];
                }

                // ✅ Bulk insert (optimized)
                $room->room_images()->createMany($imagesData);
            }

            DB::commit();
            return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
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
        $record = Room::with(['room_type', 'room_feature', 'services', 'room_images'])->findOrFail($id);
        return view('admin.rooms.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, $id)
    {
		DB::beginTransaction();
        try {
            // ✅ 1. Get validated data
            $validated = $request->validated();

            // ✅ 2. Fetch Room with relations
            $room = Room::with(['room_images', 'room_feature'])->findOrFail($id);

            // ✅ 3. Update Room
            $room->update([
                'room_type_id' => $validated['room_type_id'],
                'room_number'  => $validated['room_number'],
                'price'        => $validated['price'],
                'status'       => $validated['status'] ?? $room->status,
            ]);

            // ✅ 4. Update Feature (One-to-One)
            $room->room_feature()->updateOrCreate(
                ['room_id' => $room->id],
                [
                    'size'        => $validated['size'] ?? null,
                    'capacity'    => $validated['capacity'] ?? null,
                    'bed'         => $validated['bed'] ?? null,
                    'description' => $validated['description'] ?? null,
                ]
            );

            // ✅ 5. Sync Services (Many-to-Many)
            $room->services()->sync($validated['services'] ?? []);
            

            // ✅ 6. Replace Images (ONLY if new images uploaded)
            $files = $request->file('images') ?? [];

            if (!empty($files)) {
                $destinationPath = public_path('admin/images/rooms');

                // 🔥 Delete old images
                foreach ($room->room_images ?? [] as $img) {
                    $oldPath = $destinationPath . '/' . $img->image;

                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                }

                // Delete DB records
                $room->room_images()->delete();

                // Upload new images (NO RESIZE)
                $imagesData = [];

                foreach ($files as $file) {
                    $fileName = 'room_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // ✅ Direct move (no Intervention Image)
                    $file->move($destinationPath, $fileName);

                    $imagesData[] = [
                        'image' => $fileName
                    ];
                }

                // Bulk insert
                $room->room_images()->createMany($imagesData);
            }

            DB::commit();
            return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
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
        $record = Room::with('room_images')->withTrashed()->findOrFail($id);

        foreach ($room->room_images as $img) {
            @unlink(public_path('admin/images/rooms/'.$img->image));
        }

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
