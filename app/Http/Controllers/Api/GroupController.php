<?php

namespace App\Http\Controllers\Api;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utilities\AccredibleService;

class GroupController extends Controller
{
    public function __construct(AccredibleService $accredible)
    {
        $this->accredible = $accredible;
    }

    public function index()
    {
        $groups = Group::all();

        return response()->success($groups);
    }

    public function getGroup($group_id)
    {
        $group = $this->accredible->get_group($group_id);

        return response()->success($group);
    }

    public function getDesign($design_id) 
    {
        $design = $this->accredible->get_design($design_id);

        return response()->success($design);

    }
}
