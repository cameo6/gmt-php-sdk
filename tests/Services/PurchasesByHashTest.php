<?php

namespace Tests\Services;

use Gmt\Client;
use Gmt\Core\Util;
use Gmt\PurchasesByHash\PurchasesByHashGetResponse;
use Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class PurchasesByHashTest extends TestCase
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
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->purchasesByHash->retrieve('abc-def-1234567890');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PurchasesByHashGetResponse::class, $result);
    }

    #[Test]
    public function testRequestVerificationCode(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->purchasesByHash->requestVerificationCode(
            'abc-def-1234567890'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            PurchasesByHashRequestVerificationCodeResponse::class,
            $result
        );
    }
}
