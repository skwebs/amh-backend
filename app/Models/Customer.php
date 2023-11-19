<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasUlids; //add HasUuids if use uuid instead id;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        // 'uuid',
        'mobile',
        'email',
        'password',
        'address',
        'last_purchase',
        'last_payment',
        'balance',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Set uuid in transaction_id
     *
     * @return Attribute
     */
    // protected function createdAt(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn (string $value) => [
    //             'created_at' => $value,
    //             'uuid' => Str::uuid(),
    //         ],
    //     );
    // }


    /**
     * Interact with the created_at.
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d-m-Y H:i:s'),
            set: fn (string $value) => Carbon::parse($value)->format('Y-m-d H:i:s'),
        );
    }

    /**
     * Interact with the updated_at.
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d-m-Y H:i:s'),
            set: fn (string $value) => Carbon::parse($value)->format('Y-m-d H:i:s'),
        );
    }
}
