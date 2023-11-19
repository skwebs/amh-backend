<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, HasUlids; //add HasUuids if use uuid instead id;

    protected $fillable = [
        // 'uuid',
        'customer_id',
        'debit',
        'credit',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Set uuid in uuid
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
