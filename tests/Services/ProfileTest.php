<?php

namespace Tests\Services;

use Gmt\Client;
use Gmt\Core\Util;
use Gmt\Profile\ProfileChangeLanguageResponse;
use Gmt\Profile\ProfileChangeLoginResponse;
use Gmt\Profile\ProfileChangePasswordResponse;
use Gmt\Profile\ProfileGetResponse;
use Gmt\Profile\ProfileUnbindTelegramResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ProfileTest extends TestCase
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

        $result = $this->client->profile->retrieve();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProfileGetResponse::class, $result);
    }

    #[Test]
    public function testChangeLanguage(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->profile->changeLanguage(language: 'en');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProfileChangeLanguageResponse::class, $result);
    }

    #[Test]
    public function testChangeLanguageWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->profile->changeLanguage(language: 'en');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProfileChangeLanguageResponse::class, $result);
    }

    #[Test]
    public function testChangeLogin(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->profile->changeLogin(newLogin: 'username');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProfileChangeLoginResponse::class, $result);
    }

    #[Test]
    public function testChangeLoginWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->profile->changeLogin(newLogin: 'username');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProfileChangeLoginResponse::class, $result);
    }

    #[Test]
    public function testChangePassword(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->profile->changePassword(
            newPassword: 'Password123'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProfileChangePasswordResponse::class, $result);
    }

    #[Test]
    public function testChangePasswordWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->profile->changePassword(
            newPassword: 'Password123'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProfileChangePasswordResponse::class, $result);
    }

    #[Test]
    public function testUnbindTelegram(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->profile->unbindTelegram();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProfileUnbindTelegramResponse::class, $result);
    }
}
