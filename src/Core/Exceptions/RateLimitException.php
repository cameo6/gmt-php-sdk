<?php

namespace GmtPhpSDK\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'GmtPhpSDK Rate Limit Exception';
}
