<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class Yodlee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body'
    ];

    public static function appLogin() {
        $client = new Client(); //GuzzleHttp\Client


        $response = $client->request('POST', 'https://developer.api.yodlee.com/ysl/cobrand/login', [
            'headers' => [
                'Connection' => 'keep-alive',
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Api-Version' => '1.1',
                'Cobrand-Name' => 'restserver',
                'Accept-Encoding' => 'gzip, deflate, sdch, br',
                'Accept-Language' => 'en-US,en;q=0.8',
                ],
            'body' => json_encode([
                'cobrand' => [
                    'cobrandLogin' => 'sbCobdf26fce12b038f5a650fd144c92878c95a',
                    'cobrandPassword' => '28fab632-96db-49a6-a992-1358df021a6f',
                    'locale' => 'en_US'
                ]
            ])
        ]);

        if ($response->getStatusCode() === 200) {
            return $response->getBody();
        } else {
            return 'error ' . $response->getStatusCode();
        }
    }
}
