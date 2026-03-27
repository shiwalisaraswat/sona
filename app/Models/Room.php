<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use App\Models\RoomType;

class Room extends Model
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    use SoftDeletes;

    // use \Kyslik\ColumnSortable\Sortable;

    public $table = "rooms";

    // public $sortable = ['id', 'name', 'description', 'status'];

    protected $fillable = [
        'room_type_id', 'room_number', 'price', 'status'
    ];

    protected $dates = ['deleted_at'];

    /**
    * Get the user that owns the phone.
    */
    public function room_type(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

}
