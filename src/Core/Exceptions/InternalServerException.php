<?php

namespace GmtPhpSDK\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'GmtPhpSDK Internal Server Exception';
}
