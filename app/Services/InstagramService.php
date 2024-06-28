<?php
namespace App\Services;

use App\Models\General;
use GuzzleHttp\Client;

class InstagramService
{
    protected $client;
    protected $accessToken;

    public function __construct()
    {
        $general = General::find(1);
        
        $this->client = new Client();
        $this->accessToken = $general->ig_token;
    }

    public function getUserMedia()
    {
        $url = "https://graph.instagram.com/me/media";
        $params = [
            'fields' => 'id,caption,media_type,media_url,thumbnail_url,permalink',
            'access_token' => $this->accessToken
        ];

        $response = $this->client->get($url, ['query' => $params]);
        $body = $response->getBody();
        $data = json_decode($body, true);

        return $data['data'];
    }
}
