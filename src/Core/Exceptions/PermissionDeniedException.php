<?php

namespace Gmt\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Gmt Permission Denied Exception';
}
