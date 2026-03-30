<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomFeature extends Model
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    public $table = "room_features";

    protected $fillable = [
        'room_id', 'size', 'capacity', 'bed', 'description'
    ];


    /**
    * Get the room that owns the room_feature.
    */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

}
