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

    public function request($args = ['type' => 'POST', 'endpoint' => '/categories/get', 'headers' => ['Content-Type' => 'application/json'], 'body' => null]) {
        $client = new Client();

        dd($args);
        
        $response = $client->request('POST', $this->uri . $args['endpoint'], [
            'headers' => $args['headers'],
            'body' => json_encode($args['body'])
        ]);

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents());
        } else {
            return 'error ' . $response->getStatusCode();
        }
    }

    public function testPoint() {

        dd($this->request());
    }

    // Item management
    public function accountsGet() {
        dd($this->request(['endpoint' => '/accounts/get']));
    }

    // Item management
    public function itemGet() {
        dd($this->request(['endpoint' => '/item/get']));
    }

    // Item management
    public function itemWebhookUpdate() {
        dd($this->request(['endpoint' => '/item/webhook/update']));
    }

    // Item management
    public function itemAccessTokenInvalidate() {
        dd($this->request(['endpoint' => '/item/access_token/invalidate']));
    }

    // Item management
    public function itemAccessTokenUpdateVersion() {
        dd($this->request(['endpoint' => '/item/access_token/update_version']));
    }

    // Item management
    public function itemRemove() {
        dd($this->request(['endpoint' => '/item/remove']));
    }

    // Product access
    public function authGet() {
        dd($this->request(['endpoint' => '/auth/get']));
    }

    // Product access
    public function transactionsGet() {
        dd($this->request(['endpoint' => '/transactions/get']));
    }

    // Product access
    public function accountsBalanceGet() {
        dd($this->request(['endpoint' => '/accounts/balance/get']));
    }

    // Product access
    public function identityGet() {
        dd($this->request(['endpoint' => '/identity/get']));
    }

    // Product access
    public function incomeGet() {
        dd($this->request(['endpoint' => '/income/get']));
    }

    // Product access
    public function accessReportGet() {
        dd($this->request(['endpoint' => '/asset_report/get']));
    }

    // Product access
    public function assetReportPdfGet() {
        dd($this->request(['endpoint' => '/asset_report/pdf/get']));
    }

    // Report management
    public function assetReportCreate() {
        dd($this->request(['endpoint' => '/asset_report/create']));
    }

    // Report management
    public function assetReportRemove() {
        dd($this->request(['endpoint' => '/asset_report/remove']));
    }

    // Report management
    public function assetReportAuditCopyCreate() {
        dd($this->request(['endpoint' => '/asset_report/audit_copy/create']));
    }

    // Report management
    public function assetReportAuditCopyRemove() {
        dd($this->request(['endpoint' => '/asset_report/audit_copy/remove']));
    }

    // Institutions
    public function institutionsGet() {
        dd($this->request(['endpoint' => '/institutions/get']));
    }

    // Institutions
    public function institutionsGetById() {
        dd($this->request(['endpoint' => '/institutions/get_by_id']));
    }

    // Institutions
    public function institutionsSearch() {
        dd($this->request(['endpoint' => '/institutions/search']));
    }

    // Categories
    public function categoriesGet() {
        dd($this->request());
    }

}
