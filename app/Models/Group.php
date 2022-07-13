<?php

namespace App\Models;

use App\Models\Certification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'course_name',
        'certificate_design_id'
    ];

    public function certificates(): HasMany
    {
        return $this->hasMany(Certification::class, 'group_id', 'id');
    }
}
