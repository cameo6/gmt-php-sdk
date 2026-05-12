<?php

declare(strict_types=1);

namespace Gmt;

use Gmt\Core\BaseClient;
use Gmt\Core\Implementation\StreamingHttpClient;
use Gmt\Core\Util;
use Gmt\Services\AccountsService;
use Gmt\Services\ProfileService;
use Gmt\Services\PurchasesByHashService;
use Gmt\Services\PurchasesService;
use Gmt\Services\ServiceService;
use Gmt\Services\TelegramService;
use Gmt\Services\WebhooksService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \Gmt\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
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

    /**
     * @api
     */
    public PurchasesByHashService $purchasesByHash;

    /**
     * @api
     */
    public TelegramService $telegram;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? Util::getenv('GMT_API_KEY'));

        $baseUrl ??= Util::getenv('GMT_BASE_URL') ?: 'https://api.getmytg.com';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        if (is_null($options->streamingTransporter)) {
            assert(!is_null($options->transporter));
            $options->streamingTransporter = new StreamingHttpClient($options->transporter);
        }

        /** @var array<string, string|null> $headers */
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('gmt/PHP %s', VERSION),
            'X-Stainless-Lang' => 'php',
            'X-Stainless-Package-Version' => '0.0.1',
            'X-Stainless-Arch' => Util::machtype(),
            'X-Stainless-OS' => Util::ostype(),
            'X-Stainless-Runtime' => php_sapi_name(),
            'X-Stainless-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv('GMT_CUSTOM_HEADERS');
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr($line, $colon + 1));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options
        );

        $this->service = new ServiceService($this);
        $this->accounts = new AccountsService($this);
        $this->profile = new ProfileService($this);
        $this->purchases = new PurchasesService($this);
        $this->purchasesByHash = new PurchasesByHashService($this);
        $this->telegram = new TelegramService($this);
        $this->webhooks = new WebhooksService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['x-api-key' => $this->apiKey] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
