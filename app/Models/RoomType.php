<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{

    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    // use \Kyslik\ColumnSortable\Sortable;

    public $table = "room_types";

    // public $sortable = ['id', 'name', 'description', 'status'];

    protected $fillable = [
        'name', 'description', 'status'
    ];

    public static function getRoomTypesListing(){
        $get_room_types_listing = RoomType::pluck('name','id')->toArray();
        return $get_room_types_listing;
    }

}
