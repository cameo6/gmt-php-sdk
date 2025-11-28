<?php

namespace Gmt\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Gmt Conflict Exception';
}
