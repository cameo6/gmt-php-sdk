<?php

namespace Tests\Services;

use Gmt\Client;
use Gmt\Core\Util;
use Gmt\Telegram\TelegramGetPremiumPriceResponse;
use Gmt\Telegram\TelegramGetStarsPriceResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class TelegramTest extends TestCase
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
    public function testGetPremiumPrice(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->telegram->getPremiumPrice(mounts: 'mounts');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TelegramGetPremiumPriceResponse::class, $result);
    }

    #[Test]
    public function testGetPremiumPriceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->telegram->getPremiumPrice(mounts: 'mounts');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TelegramGetPremiumPriceResponse::class, $result);
    }

    #[Test]
    public function testGetStarsPrice(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->telegram->getStarsPrice(amount: 'amount');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TelegramGetStarsPriceResponse::class, $result);
    }

    #[Test]
    public function testGetStarsPriceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->telegram->getStarsPrice(amount: 'amount');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TelegramGetStarsPriceResponse::class, $result);
    }
}
