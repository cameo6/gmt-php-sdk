<?php

namespace Tests\Services;

use Gmt\Accounts\AccountGetResponse;
use Gmt\Client;
use Gmt\PageNumber;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class AccountsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->retrieve('US');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->list([
            'page' => 1, 'pageSize' => 50, 'sort' => 'price_asc',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $result);
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->list([
            'page' => 1,
            'pageSize' => 50,
            'sort' => 'price_asc',
            'countryCodes' => 'US,RU,GB',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $result);
    }

    #[Test]
    public function testListCountries(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->listCountries([
            'page' => 1, 'pageSize' => 50, 'sort' => 'price_asc',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $result);
    }

    #[Test]
    public function testListCountriesWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->listCountries([
            'page' => 1,
            'pageSize' => 50,
            'sort' => 'price_asc',
            'countryCodes' => 'US,RU,GB',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PageNumber::class, $result);
    }
}
