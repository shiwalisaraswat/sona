<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Room;

class RoomsController extends Controller
{

    public function index(Request $request): View
    {
        $records = Room::with(['room_type', 'room_feature', 'services', 'room_images', 'first_image']);

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->where('room_number', 'like', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('rooms', ['records' => $records]);
    }

    public function detail($id)
    {
        $record = Room::with(['room_type', 'room_feature', 'services', 'room_images', 'first_image'])->findOrFail($id);

        return view('room_detail', compact('record'));
    }

}
