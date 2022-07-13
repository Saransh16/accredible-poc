<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
