<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    const PROFILE_PIC_PATH = "admin/images/profile";

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $guard = 'admin'; // added custom guard "admin"

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_pic'
    ];

    // Append custom attribute
    protected $appends = ['profile_pic_url'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Accessor
    public function getProfilePicUrlAttribute()
    {
        $basePath = 'public/' . trim(self::PROFILE_PIC_PATH, '/');

        if (!empty($this->profile_pic)) {

            $filePath = public_path(self::PROFILE_PIC_PATH . '/' . $this->profile_pic);

            if (file_exists($filePath)) {
                return asset($basePath . '/' . $this->profile_pic);
            }
        }

        return asset('public/admin/images/default/avatar.png');
    }
}
