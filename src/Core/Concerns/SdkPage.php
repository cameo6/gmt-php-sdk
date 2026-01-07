<?php

declare(strict_types=1);

namespace Gmt\Core\Concerns;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Conversion\Contracts\Converter;
use Gmt\Core\Conversion\Contracts\ConverterSource;
use Gmt\Core\Exceptions\APIStatusException;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type NormalizedRequest from \Gmt\Core\BaseClient
 *
 * @internal
 *
 * @template Item
 */
trait SdkPage
{
    private Converter|ConverterSource|string $convert;

    private Client $client;

    /**
     * @return list<Item>
     */
    abstract public function getItems(): array;

    public function hasNextPage(): bool
    {
        return !is_null($this->nextRequest());
    }

    /**
     * Get the next page of results.
     * Before calling this method, you must check if there is a next page
     * using {@link hasNextPage()}.
     *
     * @return static of static<Item>
     *
     * @throws APIStatusException
     */
    public function getNextPage(): static
    {
        $next = $this->nextRequest();
        if (!$next) {
            throw new \RuntimeException(
                'No next page expected; please check `.hasNextPage()` before calling `.getNextPage()`.'
            );
        }

        [$req, $opts] = $next;

        // @phpstan-ignore-next-line argument.type
        /** @var BaseResponse<static> */
        $response = $this->client->request(...$req, convert: $this->convert, page: $this::class, options: $opts);

        // @phpstan-ignore-next-line return.type
        return $response->parse();
    }

    /**
     * Iterator yielding each page (instance of static).
     *
     * @return \Generator<static>
     */
    public function getIterator(): \Generator
    {
        $page = $this;

        yield $page;
        while ($page->hasNextPage()) {
            $page = $page->getNextPage();

            yield $page;
        }
    }

    /**
     * Iterator yielding each item across all pages.
     *
     * @return \Generator<Item>
     */
    public function pagingEachItem(): \Generator
    {
        foreach ($this as $page) {
            foreach ($page->getItems() as $item) {
                yield $item;
            }
        }
    }

    /**
     * @internal
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    abstract protected function nextRequest(): ?array;
}
