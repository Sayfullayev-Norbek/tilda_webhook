<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebhookData;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {

        // Tokenni tekshirish
        $token = $request->header('X-Tilda-Token');
        if ($token !== env('TILDA_WEBHOOK_TOKEN')) {
            return response()->json(['error' => 'Token bilan '], 401);
        }

        $data = $request->validate([
            'email' => 'required|email',
            'Name' => 'nullable|string',
            'Phone' => 'nullable|string',
            'Comments' => 'nullable|string',
        ]);
        // Webhook ma'lumotlarini saqlash
        WebhookData::create($data);

        return response()->json(['status' => 'success'], 200);
    }
}
