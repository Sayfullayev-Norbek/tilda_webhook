<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webhook;
use App\Models\Company;
use App\Models\PhoneNumber;
use App\Service\ModmeService;

class WebhookController extends Controller
{

    private ModmeService $modmeService;


    public function __construct(ModmeService $modmeService)
    {
        $this->modmeService = $modmeService;
    }

    public function create(Request $request, $branch_id){

        $token = $request->token;

        $company = Company::query()
            ->where('modme_token', $token)->first();

        if($company){

            $tokenInfo = $this->modmeService->checkToken($token);

            if(is_array($tokenInfo) && isset($tokenInfo['data']['company']['id'])){

                $company_id = $tokenInfo['data']['company']['id'];
                $company_name = $tokenInfo['data']['company']['name'];

                $data = $request->all();

                $baseData = [
                    'modme_company_id' =>$company_id,
                ];

                $comments = $data['comments'] ?? '    ';
                $phoneNumbers = [];
                $isFirstPhoneNumber = true;
                $i = 0;

                foreach ($data as $key => $value) {
                    if (str_starts_with($key, 'Phone')) {
                        $phoneNumbers[] = $value;

                        if (! $isFirstPhoneNumber) {
                            $comments .= "  , Phone " . $i .": " . $value . " ";
                        }

                        $isFirstPhoneNumber = false;
                        $i++;
                        unset($data[$key]);
                    }
                }

                $data['comments'] = $comments;
                $webhookData = array_merge($baseData, $data);
                $webhook = Webhook::create($webhookData);

                foreach ($phoneNumbers as $phoneNumber) {
                    PhoneNumber::create([
                        'phone_number' => $phoneNumber,
                        'webhook_id' => $webhook->id
                    ]);
                }

                $data['modme_company_id'] = $company_id;
                $data['branch_id'] = $branch_id;
                $data['Phone'] = $request->Phone;


                $leadResponse = $this->modmeService->sendLead($data);

                if (!$leadResponse) {
                    return response()->json(['ERROR' => 'Leadga yuborishda muammo!'], 500);
                }

                return response()->json(['status' => 'success'], 200);
            }else{
                return "Token Xato";
            }
        }else{
            return "Forma ma'lumotlari bazaga yozish uchun o'quv markaz ro'yhatdan o'tmagan ";
        }

    }
}
