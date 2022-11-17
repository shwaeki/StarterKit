<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory, HasRoles, LogsActivity, ThrottlesLogins;

    protected static $ignoreChangedAttributes = ['password'];

    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'profile_photo', 'status'];


    protected $hidden = [
        'password', 'remember_token',
    ];
    protected static $logFillable = true;
    protected static $logName = 'user';
    protected static $logOnlyDirty = true;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setStatusAttribute($status)
    {
        $this->attributes['status'] = ($status) ? 1 : 0;
    }

    public function getProfilePhotoAttribute()
    {
        if (file_exists(public_path() . $this->attributes['profile_photo']))
            return $this->attributes['profile_photo'];

        return "https://via.placeholder.com/150/555/fff?text=N/A";

    }

    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password)) {
            $password = Hash::make($password);
            $this->attributes['password'] = $password;
        }
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
