<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomImage extends Model
{
    const IMAGE_PATH = "admin/images/rooms";

    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    public $table = "room_images";

    protected $fillable = [
        'room_id', 'image'
    ];

    // Append custom attribute
    protected $appends = ['image_url'];

    /**
    * Get the room that owns the room_image.
    */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // Accessor
    public function getImageUrlAttribute()
    {
        $basePath = 'public/' . trim(self::IMAGE_PATH, '/');

        if (!empty($this->image)) {

            $filePath = public_path(self::IMAGE_PATH . '/' . $this->image);

            if (file_exists($filePath)) {
                return asset($basePath . '/' . $this->image);
            }
        }

        return asset('public/admin/images/default/placeholder1.png');
    }

}
