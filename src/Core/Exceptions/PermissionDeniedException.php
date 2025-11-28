<?php

namespace GmtPhpSDK\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'GmtPhpSDK Permission Denied Exception';
}
