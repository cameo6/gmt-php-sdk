<?php

namespace Gmt\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Gmt Rate Limit Exception';
}
