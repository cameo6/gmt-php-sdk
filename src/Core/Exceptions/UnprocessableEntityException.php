<?php

namespace Gmt\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Gmt Unprocessable Entity Exception';
}
