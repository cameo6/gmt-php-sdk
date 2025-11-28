<?php

namespace Gmt\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Gmt Internal Server Exception';
}
