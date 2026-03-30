<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    public $table = "contacts";

    protected $fillable = [
        'user_id', 'name', 'email', 'message'
    ];

}
