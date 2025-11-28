<?php

namespace Gmt\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Gmt Authentication Exception';
}
