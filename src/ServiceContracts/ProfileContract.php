<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\ProfileGetResponse;
use Gmt\RequestOptions;

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
