<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use App\Models\Room;

class RoomType extends Model
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    use SoftDeletes;

    // use \Kyslik\ColumnSortable\Sortable;

    public $table = "room_types";

    // public $sortable = ['id', 'name', 'description', 'status'];

    protected $fillable = [
        'name', 'description', 'status'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the rooms for the room_type.
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public static function getRoomTypesListing(){
        $get_room_types_listing = RoomType::pluck('name','id')->toArray();
        return $get_room_types_listing;
    }

}
