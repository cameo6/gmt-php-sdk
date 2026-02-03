<?php

namespace Tests\Services;

use Gmt\Client;
use Gmt\Core\Util;
use Gmt\Service\ServiceGetServerTimeResponse;
use Gmt\Service\ServiceHealthCheckResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ServiceTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testGetServerTime(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->service->getServerTime();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ServiceGetServerTimeResponse::class, $result);
    }

    #[Test]
    public function testHealthCheck(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->service->healthCheck();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ServiceHealthCheckResponse::class, $result);
    }
}
