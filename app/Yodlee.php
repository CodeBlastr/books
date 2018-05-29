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
        $result = $client->post('your-request-uri', [
            'form_params' => [
                'sample-form-data' => 'value'
            ]
        ]);
        dd($result);
    }
}
