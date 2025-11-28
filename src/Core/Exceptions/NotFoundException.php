<?php

namespace Gmt\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Gmt Not Found Exception';
}
