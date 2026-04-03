<?php

namespace Tests\Services;

use Gmt\Client;
use Gmt\Core\Util;
use Gmt\PageNumber;
use Gmt\Purchases\PurchaseGetResponse;
use Gmt\Purchases\PurchaseListResponse;
use Gmt\Purchases\PurchaseNewResponse;
use Gmt\Purchases\PurchaseRefundResponse;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class PurchasesTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->purchases->create(countryCode: 'US');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PurchaseNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->purchases->create(countryCode: 'US');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PurchaseNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->purchases->retrieve(12345);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PurchaseGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->purchases->list(
            page: 1,
            pageSize: 50,
            sort: 'date_desc'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(PurchaseListResponse::class, $item);
        }
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->purchases->list(
            page: 1,
            pageSize: 50,
            sort: 'date_desc',
            phoneNumber: '123',
            status: 'SUCCESS',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(PurchaseListResponse::class, $item);
        }
    }

    #[Test]
    public function testRefund(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->purchases->refund(12345);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PurchaseRefundResponse::class, $result);
    }

    #[Test]
    public function testRequestVerificationCode(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->purchases->requestVerificationCode(12345);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            PurchaseRequestVerificationCodeResponse::class,
            $result
        );
    }
}
