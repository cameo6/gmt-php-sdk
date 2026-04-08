<?php

namespace Tests\Services\Telegram;

use Gmt\Client;
use Gmt\Core\Util;
use Gmt\PageNumber;
use Gmt\Telegram\Purchases\PurchaseListPremiumResponse;
use Gmt\Telegram\Purchases\PurchaseListStarsResponse;
use Gmt\Telegram\Purchases\PurchaseNewPremiumResponse;
use Gmt\Telegram\Purchases\PurchaseNewStarsResponse;
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
    public function testCreatePremium(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->telegram->purchases->createPremium(
            mounts: 6,
            username: '@john_doe'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PurchaseNewPremiumResponse::class, $result);
    }

    #[Test]
    public function testCreatePremiumWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->telegram->purchases->createPremium(
            mounts: 6,
            username: '@john_doe'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PurchaseNewPremiumResponse::class, $result);
    }

    #[Test]
    public function testCreateStars(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->telegram->purchases->createStars(
            amount: 100,
            username: '@john_doe'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PurchaseNewStarsResponse::class, $result);
    }

    #[Test]
    public function testCreateStarsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->telegram->purchases->createStars(
            amount: 100,
            username: '@john_doe'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PurchaseNewStarsResponse::class, $result);
    }

    #[Test]
    public function testListPremium(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->telegram->purchases->listPremium(
            page: 1,
            pageSize: 50
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(PurchaseListPremiumResponse::class, $item);
        }
    }

    #[Test]
    public function testListPremiumWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->telegram->purchases->listPremium(
            page: 1,
            pageSize: 50
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(PurchaseListPremiumResponse::class, $item);
        }
    }

    #[Test]
    public function testListStars(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->telegram->purchases->listStars(
            page: 1,
            pageSize: 50
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(PurchaseListStarsResponse::class, $item);
        }
    }

    #[Test]
    public function testListStarsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->telegram->purchases->listStars(
            page: 1,
            pageSize: 50
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(PurchaseListStarsResponse::class, $item);
        }
    }
}
