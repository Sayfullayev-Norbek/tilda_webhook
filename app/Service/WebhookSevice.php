<?php

namespace App\Service;

use App\Models\WebhookData;

class WebhookService
{
    public function token(string $token): bool
    {

        return $token == env('TILDA_WEBHOOK_TOKEN');

    }

    public function create(array $data): bool
    {

        WebhookData::create($data);

        return true;
    }
}
