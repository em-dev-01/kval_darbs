<?php

namespace App\Models;

use App\Enums\ClientRequestStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClientRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'email',
        'status'
    ];

    protected $casts = [
        'status' => ClientRequestStatusEnum::class
    ];
}
