<?php

namespace Gmt;

use Gmt\Core\Attributes\Optional;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkPage;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Core\Contracts\BasePage;
use Gmt\Core\Conversion;
use Gmt\Core\Conversion\Contracts\Converter;
use Gmt\Core\Conversion\Contracts\ConverterSource;
use Gmt\Core\Conversion\ListOf;
use Gmt\PageNumber\Pagination;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-type PageNumberShape = array{
 *   items?: list<mixed>|null, pagination?: Pagination|null
 * }
 *
 * @template TItem
 *
 * @implements BasePage<TItem>
 */
final class PageNumber implements BaseModel, BasePage
{
    /** @use SdkModel<PageNumberShape> */
    use SdkModel;

    /** @use SdkPage<TItem> */
    use SdkPage;

    /** @var list<TItem>|null $items */
    #[Optional(list: 'mixed')]
    public ?array $items;

    #[Optional]
    public ?Pagination $pagination;

    /**
     * @internal
     *
     * @param array{
     *   method: string,
     *   path: string,
     *   query: array<string,mixed>,
     *   headers: array<string,string|list<string>|null>,
     *   body: mixed,
     * } $requestInfo
     */
    public function __construct(
        private string|Converter|ConverterSource $convert,
        private Client $client,
        private array $requestInfo,
        private RequestOptions $options,
        private ResponseInterface $response,
        private mixed $parsedBody,
    ) {
        $this->initialize();

        if (!is_array($this->parsedBody)) {
            return;
        }

        // @phpstan-ignore-next-line argument.type
        self::__unserialize($this->parsedBody);

        if (is_array($items = $this->offsetGet('items'))) {
            $parsed = Conversion::coerce(new ListOf($convert), value: $items);
            // @phpstan-ignore-next-line
            $this->offsetSet('items', value: $parsed);
        }
    }

    /** @return list<TItem> */
    public function getItems(): array
    {
        // @phpstan-ignore-next-line return.type
        return $this->offsetGet('items') ?? [];
    }

    /**
     * @internal
     *
     * @return array{
     *   array{
     *     method: string,
     *     path: string,
     *     query: array<string,mixed>,
     *     headers: array<string,string|list<string>|null>,
     *     body: mixed,
     *   },
     *   RequestOptions,
     * }|null
     */
    public function nextRequest(): ?array
    {
        /** @var int */
        $curr = $this->pagination->currentPage ?? null;
        if (!($this
            ->pagination->hasNext ?? null) || !count($this->getItems()) || ($curr >= ($this
            ->pagination->totalPages ?? null))) {
            return null;
        }

        $nextRequest = array_merge_recursive(
            $this->requestInfo,
            ['query' => $curr + 1]
        );

        // @phpstan-ignore-next-line return.type
        return [$nextRequest, $this->options];
    }
}
