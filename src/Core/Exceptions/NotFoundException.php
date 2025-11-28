<?php

namespace GmtPhpSDK\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'GmtPhpSDK Not Found Exception';
}
