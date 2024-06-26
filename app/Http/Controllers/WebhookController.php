<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webhook;
use App\Models\Company;
use App\Service\ModmeService;

class WebhookController extends Controller
{

    private ModmeService $modmeService;


    public function __construct(ModmeService $modmeService)
    {
        $this->modmeService = $modmeService;
    }

    public function create(Request $request){

        $token = $request->header('token');

        $company = Company::query()
            ->where('modme_token', $token)->first();

        if($company){

            $tokenInfo = $this->modmeService->checkToken($token);

            if($tokenInfo && $tokenInfo['data']['company']['id']){

                $company_id = $tokenInfo['data']['company']['id'];
                $company_name = $tokenInfo['data']['company']['name'];

                $data = $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'comments' => 'nullable',
                ]);
                $data['modme_company_id'] = $company_id;

                $leadResponse = $this->modmeService->sendLead($data);

                if (!$leadResponse) {
                    return response()->json(['ERROR' => 'Leadga yuborishda muammo!'], 500);
                }

                Webhook::create($data);

                return response()->json(['status' => 'success'], 200);
            }else{
                return "Token Xato";
            }
        }else{
            return "Forma ma'lumotlari bazaga yozish uchun o'quv markaz ro'yhatdan o'tmagan ";
        }

    }
}
