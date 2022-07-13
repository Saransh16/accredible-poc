<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
