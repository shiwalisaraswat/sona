<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasOne, BelongsToMany};

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

    public function room_images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function first_image()
    {
        return $this->hasOne(RoomImage::class)->latestOfMany();
    }

    public function room_feature()
    {
        return $this->hasOne(RoomFeature::class);
    }

    // public function room_services()
    // {
    //     return $this->hasMany(RoomService::class);
    // }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'room_services');
    }

}
