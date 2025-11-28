<?php

declare(strict_types=1);

namespace GmtPhpSDK\ServiceContracts;

use GmtPhpSDK\Core\Exceptions\APIException;
use GmtPhpSDK\Profile\ProfileGetResponse;
use GmtPhpSDK\RequestOptions;

interface ProfileContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        ?RequestOptions $requestOptions = null
    ): ProfileGetResponse;
}
