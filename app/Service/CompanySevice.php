<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use App\Models\Company;

class CompanyService
{
    private string $tokenInfo;

    public function setToken(string $tokenInfo): void
    {
        $this->tokenInfo = $tokenInfo;
    }
    public function store(array $tokenInfo)
    {
        return $tokenInfo;
    }
}
