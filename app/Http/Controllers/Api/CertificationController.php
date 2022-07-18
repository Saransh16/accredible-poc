<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Controllers\Controller;
use App\Utilities\AccredibleService;

class CertificationController extends Controller
{
    public function __construct(AccredibleService $accredible)
    {
        $this->accredible = $accredible;
    }

    public function create()
    {
        $inputs = request()->all();

        $issue_date = Carbon::now()->format('d/m/Y');
        $expiry_date = $inputs['attributes']['expiry_date'] ?? Carbon::now()->addDays('1')->format('d/m/Y');

        $credential = $this->accredible->create_credential(auth()->user()->name, auth()->user()->email, $inputs['group_id'], $issue_date, $expiry_date, $inputs['attributes']);

        $certificate = Certification::create([
            'user_id' => auth()->user()->id,
            'credential_id' => $credential['credential']['id'],
            'url' => $credential['credential']['certificate']['image']['preview'],
            'issued_on' => $credential['credential']['issued_on'],
            'expired_on' => $credential['credential']['expired_on'],
            'group_id' => $credential['credential']['group_id']
        ]);

        return response()->success($certificate);
    }

    public function expireCredential()
    {

        $inputs = request()->all();

        $expiry_date = Carbon::now()->format('d/m/Y');

        $credential = $this->accredible->expire_credential($inputs['credential_id'], auth()->user()->name, auth()->user()->email, $inputs['group_id'], $expiry_date);

        // $certificate = Certification::create([
        //     'user_id' => auth()->user()->id,
        //     'credential_id' => $credential['credential']['id'],
        //     'url' => $credential['credential']['certificate']['image']['preview'],
        //     'issued_on' => $credential['credential']['issued_on'],
        //     'expired_on' => $credential['credential']['expired_on'],
        //     'group_id' => $credential['credential']['group_id']
        // ]);

        return response()->success('Credential expired successfully');

    }

    public function index()
    {
        $certificates = Certification::where('user_id', auth()->user()->id)->with('group')->get();

        return response()->success($certificates);
    }
}
