<?php

declare(strict_types=1);

namespace Gmt\Profile;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\ProfileChangeLanguageParams\Language;

/**
 * Change the preferred user interface language on the website and in the bot.
 *
 * @see Gmt\Services\ProfileService::changeLanguage()
 *
 * @phpstan-type ProfileChangeLanguageParamsShape = array{
 *   language: Language|value-of<Language>
 * }
 */
final class ProfileChangeLanguageParams implements BaseModel
{
    /** @use SdkModel<ProfileChangeLanguageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Preferred user interface language.
     *
     * @var value-of<Language> $language
     */
    #[Required(enum: Language::class)]
    public string $language;

    /**
     * `new ProfileChangeLanguageParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileChangeLanguageParams::with(language: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileChangeLanguageParams)->withLanguage(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Language|value-of<Language> $language
     */
    public static function with(Language|string $language): self
    {
        $self = new self;

        $self['language'] = $language;

        return $self;
    }

    /**
     * Preferred user interface language.
     *
     * @param Language|value-of<Language> $language
     */
    public function withLanguage(Language|string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }
}
