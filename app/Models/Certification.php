<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'credential_id',
        'url',
        'issued_on',
        'expired_on',
        'group_id'
    ];
}
