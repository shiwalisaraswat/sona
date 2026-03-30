<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use App\Models\Room;

class Service extends Model
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    use SoftDeletes;

    // use \Kyslik\ColumnSortable\Sortable;

    public $table = "services";

    // public $sortable = ['id', 'name', 'status'];

    protected $fillable = [
        'name', 'status'
    ];

    protected $dates = ['deleted_at'];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_services');
    }

    public static function getServicesListing(){
        $get_services_listing = Service::pluck('name','id')->toArray();
        return $get_services_listing;
    }

}
