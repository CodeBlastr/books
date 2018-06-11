<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class Plaid extends Model
{
    /**
     * @var bool
     */
    private static $init = false;

    /**
     * @var null|string
     */
    protected static $clientId = null;

    /**
     * @var null|string
     */
    protected static $secret = null;

    /**
     * @var null|string
     */
    protected static $publicKey = null;

    /**
     * @var null|string
     */
    protected static $environment = null;

    /**
     * @var null|string
     */
    protected static $uri = null;

    /**
     * @var null|string
     */
    protected static $endpoint = null;
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
        // not needed, will never be instantiated
    }

    public static function init()
    {
        if (!self::$init) {

            self::$clientId = env('PLAID_CLIENT_ID');
            self::$secret = env('PLAID_SECRET');
            self::$publicKey = env('PLAID_PUBLIC_KEY');
            self::$environment = env('PLAID_ENV');
            self::$uri = 'https://' . self::$environment . '.plaid.com';

            // set flag to avoid re-loading if init() called again
            self::$init = true;
        }
    }

    /**
     * Send a request to Plaid
     * get a response.
     *
     *
     * @param array $args
     * @return mixed|string
     */
    public static function request(array $args = array()) {
        self::init();
        $client = new Client(); //load guzzle
        $defaultArgs = ['type' => 'POST', 'endpoint' => '/categories/get', 'headers' => ['Content-Type' => 'application/json'], 'body' => ['client_id' => self::$clientId, 'secret' => self::$secret]];
        
        $args['body'] = array_merge($defaultArgs['body'], $args['body']);
        $args = array_merge($defaultArgs, $args);

        $response = $client->request('POST', self::$uri . $args['endpoint'], [
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
