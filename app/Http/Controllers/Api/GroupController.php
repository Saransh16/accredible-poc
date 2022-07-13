<?php

namespace App\Http\Controllers\Api;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        dd("here");

        $groups = Group::all();

        return response()->success($groups);
    }
}
