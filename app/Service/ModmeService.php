<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class ModmeService
{
    private string $token;
    public string $modme_url;

    public function __construct(){
        $this->modme_url = config('app.modme_API_URL');
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function sendLead(array $data) :mixed
    {
        try {
            $client = new Client();

            $post = $client->post($this->modme_url."/v1/create_lead", [
                'query' => [
                    "name" => $data['Name'],
                    "phone" => $data['Phone'],
                    "branch_id" => $data['branch_id'],
                    "comment" => $data['comments'] ?? null,
                    "section_id" => $data['section_id'] ?? null,
                    "source_id" => $data['source_id'] ?? null,
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);
            return json_decode($post->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }


    public function checkToken(string $token) :mixed
    {
        try {
            $client = new Client();
            $post = $client->get($this->modme_url."/v2/token/me", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ]
            ]);
            return json_decode($post->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }

    public function checkCompany($token, $company_subdomain)
    {
        try {
            $client = new Client();
            $post = $client->get($this->modme_url."/v2/branches", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Referer' =>  $company_subdomain . 'modme.uz',
                    'Content-Type' => 'application/json'
                ]
            ]);
            return json_decode($post->getBody()->getContents(), true);

        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
}
