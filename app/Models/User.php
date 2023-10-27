<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'id_role',
        'created_at',
        'updated_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id'); // Verifica las claves aquí
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id_user');
    }

    public function supplierRequests()
    {
        return $this->hasMany(SupplierRequest::class, 'id_user');
    }

    public function observations()
    {
        return $this->hasMany(Observation::class, 'id_user');
    }

    public function reviews()
    {
        return $this->hasMany(SupplierRequest::class, 'id_user');
    }

    public function reviewsSupplierRequests()
    {
        return $this->belongsToMany(SupplierRequest::class, 'transitions_state_requests', 'id_reviewer', 'id_supplier_request');
    }
}
