<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomService extends Model
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    public $table = "room_services";

    protected $fillable = [
        'room_id', 'service_id'
    ];

    /**
    * Get the room that owns the room_service.
    */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
    * Get the service that owns the room_service.
    */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

}
