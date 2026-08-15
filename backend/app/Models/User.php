<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = ['password'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasRole($slug)
    {
        // allow passing array
        if (is_array($slug)) {
            return $this->roles()->whereIn('slug', $slug)->exists();
        }
        return $this->roles()->where('slug', $slug)->exists();
    }
}
