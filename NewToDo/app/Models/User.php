<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /* -----------------------------------------------------------------
     |  Mass‑assignable attributes
     |------------------------------------------------------------------*/
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',          // 'admin' or 'user'
    ];

    /* -----------------------------------------------------------------
     |  Default attribute values
     |------------------------------------------------------------------*/
    protected $attributes = [
        'role' => 'user',    // every new account starts as a regular user
    ];

    /* -----------------------------------------------------------------
     |  Hidden / cast attributes
     |------------------------------------------------------------------*/
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /* -----------------------------------------------------------------
     |  Relationships
     |------------------------------------------------------------------*/
    /**
     * All tasks created by this user.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
