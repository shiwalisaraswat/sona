<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Importing BaseController

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = Contact::query();

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->query('search').'%');
                $q->where('email', 'like', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.contacts.index', ['records' => $records]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


}
