<?php

namespace Gmt\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Gmt Bad Request Exception';
}
