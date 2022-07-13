<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utilities\AccredibleService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(AccredibleService $accredible)
    {
        $this->accredible = $accredible;
    }

    public function index()
    {
        //
    }

    public function register()
    {
        // dd(Carbon::now()->addDays('10')->format('d/m/Y'));

        $inputs = request()->all();

        $validator = Validator::make($inputs, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]); 

        if($validator->fails()) {
            return response()->error($validator->errors()->messages(), 422);
        }
        
        $user = User::create([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'password' => Hash::make($inputs['password']),
        ]);

        // $group = Group::first(); 

        // $credential = $this->accredible->create_credential($user->name, $user->email, $group->id, Carbon::now()->format('d/m/Y'), Carbon::now()->addDays('1')->format('d/m/Y'));

        auth()->loginUsingId($user->id);

        return response()->success(auth()->user());
    }

    public function login() {

        $inputs = request()->only(['email', 'password']);

        $validator = Validator::make($inputs, [
            'email' => 'required|email',
            'password' => 'required',
        ]); 

        if($validator->fails()) {
            return response()->error($validator->errors()->messages(), 422);
        }

        if(auth()->attempt($inputs))  
        return response()->success(['user' => auth()->user()]);
        
        return response()->error('Invalid credentials', 400);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function logout()
    {
        $token = auth()->user()->tokens()->delete();

        return response()->success('Logged out');
    }
}
