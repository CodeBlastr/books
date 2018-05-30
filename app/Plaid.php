<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class Plaid extends Model
{
    /**
     * @var null|string
     */
    protected $clientId = null;

    /**
     * @var null|string
     */
    protected $secret = null;

    /**
     * @var null|string
     */
    protected $publicKey = null;

    /**
     * @var null|string
     */
    protected $environment = null;

    /**
     * @var null|string
     */
    protected $uri = null;

    /**
     * @var null|string
     */
    protected $endpoint = null;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body'
    ];

    /**
     * Plaid constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->clientId = env('PLAID_CLIENT_ID');
        $this->secret = env('PLAID_SECRET');
        $this->publicKey = env('PLAID_PUBLIC_KEY');
        $this->environment = env('PLAID_ENV');
        $this->uri = 'https://' . $this->environment . '.plaid.com';
    }

    public function appLogin() {
        $client = new Client();

        $response = $client->request('POST', $this->uri . $this->institutionsGet(), [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'client_id' => $this->clientId,
                'secret' => $this->secret,
                'count' => 200,
                'offset' => 0
            ])
        ]);

        dd($response->getBody()->getContents());




        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents());
        } else {
            return 'error ' . $response->getStatusCode();
        }
    }

    public function institutionsGet() {
        $this->endpoint = '/institutions/get';
        return $this->endpoint;
    }
}
