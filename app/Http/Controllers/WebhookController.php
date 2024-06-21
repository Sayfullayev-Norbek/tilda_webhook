<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebhookData;
use App\Service\WebhookService;

class WebhookController extends Controller
{
    // private WebhookService $webhookService;

    // public function __construct()
    // {
    //     $this->webhookService = new WebhookService();
    // }

    public function handle(Request $request)
    {
        $token = $request->header('token');

        if ($token !== env('TILDA_WEBHOOK_TOKEN')) {
            return response()->json(['error' => 'Token bilan bog\'lanishda xatolik'], 401);
        }

        $data = $request->validate([
            'email' => 'required|email',
            'Name' => 'required|string',
            'Phone' => 'required|string',
            'Comments' => 'required|string',
        ]);

        // $this->webhookService->create($data);
        WebhookData::create($data);

        return response()->json(['status' => 'success'], 200);
    }
}
