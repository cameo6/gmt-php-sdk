<?php

namespace GmtPhpSDK;

use GmtPhpSDK\Core\Attributes\Api;
use GmtPhpSDK\Core\Concerns\SdkModel;
use GmtPhpSDK\Core\Concerns\SdkPage;
use GmtPhpSDK\Core\Contracts\BaseModel;
use GmtPhpSDK\Core\Contracts\BasePage;
use GmtPhpSDK\Core\Conversion;
use GmtPhpSDK\Core\Conversion\Contracts\Converter;
use GmtPhpSDK\Core\Conversion\Contracts\ConverterSource;
use GmtPhpSDK\Core\Conversion\ListOf;
use GmtPhpSDK\Core\Util;
use GmtPhpSDK\PageNumber\Pagination;
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
    #[Api(list: 'mixed', optional: true)]
    public ?array $items;

    #[Api(optional: true)]
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
     * } $request
     */
    public function __construct(
        private string|Converter|ConverterSource $convert,
        private Client $client,
        private array $request,
        private RequestOptions $options,
        ResponseInterface $response,
    ) {
        $this->initialize();

        $data = Util::decodeContent($response);

        if (!is_array($data)) {
            return;
        }

        // @phpstan-ignore-next-line
        self::__unserialize($data);

        if ($this->offsetGet('items')) {
            $acc = Conversion::coerce(
                new ListOf($convert),
                value: $this->offsetGet('items')
            );
            // @phpstan-ignore-next-line
            $this->offsetSet('items', $acc);
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
        $curr = $this->pagination->current_page ?? null;
        if (!($this
            ->pagination->has_next ?? null) || !count($this->getItems()) || ($curr >= ($this
            ->pagination->total_pages ?? null))) {
            return null;
        }

        $nextRequest = array_merge_recursive(
            $this->request,
            ['query' => $curr + 1]
        );

        // @phpstan-ignore-next-line return.type
        return [$nextRequest, $this->options];
    }
}
