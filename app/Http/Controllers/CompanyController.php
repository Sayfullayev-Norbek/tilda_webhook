<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webhook;
use App\Models\Company;
use App\Service\ModmeService;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    private ModmeService $modmeService;

    public function __construct(ModmeService $modmeService)
    {
        $this->modmeService = $modmeService;
    }

    public function index(Request $request){
        $request->validate([
            'token' => 'required',
        ]);

        $token = $request->input('token');
        $tokenInfo = $this->modmeService->checkToken($token);

        if(is_array($tokenInfo) && isset($tokenInfo['data']['company']['id'])){

            $company_id = $tokenInfo['data']['company']['id'];

            $company = Company::query()->where('modme_company_id', $company_id)->where('modme_token', $token)->first();

            if($company){

                $company_subdomain =  "https://" . $tokenInfo['data']['company']['subdomain'] . '.';
                $response = $this->modmeService->checkCompany($token, $company_subdomain);
                $company['token'] = $token;

                if (isset($response['data']) && is_array($response['data'])) {
                    $branches = $response['data'];
                    $company['branches'] = $branches;
                } else {
                    $company->branches = [];
                    \Log::error('Invalid branches data or error occurred', ['response' => $response]);
                }

                return view('index', compact('company'));
            }else{
                return view('welcome', compact('token', 'company_id'));
            }
        }else{
            return "Token Xato";
        }
    }

    public function tariffStore(Request $request){
        $request->validate([
            'token' => 'required',
            'tariff' => 'required',
            'terms' => 'accepted',
        ]);

        $token = $request->input('token');
        $tariff = $request->tariff;

        if($this->modmeService->checkToken($token)){

            $tokenInfo = $this->modmeService->checkToken($token);

            if($tokenInfo['data']['company']['id']){

                $company_id = $tokenInfo['data']['company']['id'];
                $company_name = $tokenInfo['data']['company']['name'];

                Company::create([
                    'name' => $company_name,
                    'modme_company_id' => $company_id,
                    'modme_token' => $token,
                    'tariff' => $tariff
                ]);
                return redirect()->route('index')->with('token', $token);
            }else{
                return "Company ID xato";
            }

        }else{
            return 'Modme Token bilan bog\'liq muammo!';
        }
    }
}
