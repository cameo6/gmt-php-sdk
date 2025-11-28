<?php

namespace GmtPhpSDK\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'GmtPhpSDK Conflict Exception';
}
