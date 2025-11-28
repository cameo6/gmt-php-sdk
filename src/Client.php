<?php

declare(strict_types=1);

namespace GmtPhpSDK;

use GmtPhpSDK\Core\BaseClient;
use GmtPhpSDK\Services\AccountsService;
use GmtPhpSDK\Services\ProfileService;
use GmtPhpSDK\Services\PurchasesService;
use GmtPhpSDK\Services\ServiceService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public ServiceService $service;

    /**
     * @api
     */
    public AccountsService $accounts;

    /**
     * @api
     */
    public ProfileService $profile;

    /**
     * @api
     */
    public PurchasesService $purchases;

    public function __construct(?string $apiKey = null, ?string $baseUrl = null)
    {
        $this->apiKey = (string) ($apiKey ?? getenv('x-api-key'));

        $baseUrl ??= getenv('GMT_BASE_URL') ?: 'https://api.getmytg.com';

        $options = RequestOptions::with(
            uriFactory: Psr17FactoryDiscovery::findUriFactory(),
            streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
            requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
            transporter: Psr18ClientDiscovery::find(),
        );

        parent::__construct(
            // x-release-please-start-version
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('gmt/PHP %s', '0.1.0'),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '0.1.0',
                'X-Stainless-OS' => $this->getNormalizedOS(),
                'X-Stainless-Arch' => $this->getNormalizedArchitecture(),
                'X-Stainless-Runtime' => 'php',
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            // x-release-please-end
            baseUrl: $baseUrl,
            options: $options,
        );

        $this->service = new ServiceService($this);
        $this->accounts = new AccountsService($this);
        $this->profile = new ProfileService($this);
        $this->purchases = new PurchasesService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['x-api-key' => $this->apiKey] : [];
    }
}
