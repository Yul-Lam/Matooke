<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
=======
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
>>>>>>> 1b843c810ec3fd48d1bd3bcd733da4568b6c576f

    /**
     * The attributes that are mass assignable.
     *
<<<<<<< HEAD
     * @var list<string>
=======
     * @var array<int, string>
>>>>>>> 1b843c810ec3fd48d1bd3bcd733da4568b6c576f
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
<<<<<<< HEAD
     * @var list<string>
=======
     * @var array<int, string>
>>>>>>> 1b843c810ec3fd48d1bd3bcd733da4568b6c576f
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
<<<<<<< HEAD
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
=======
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
>>>>>>> 1b843c810ec3fd48d1bd3bcd733da4568b6c576f
}
