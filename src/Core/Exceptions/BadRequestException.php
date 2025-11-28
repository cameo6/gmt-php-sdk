<?php

namespace GmtPhpSDK\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'GmtPhpSDK Bad Request Exception';
}
