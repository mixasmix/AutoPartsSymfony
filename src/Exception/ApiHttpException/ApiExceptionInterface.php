<?php

namespace App\Exception\ApiHttpException;

use App\Enum\ApiErrorCode;

interface ApiExceptionInterface
{
    public function getErrors(): array;

    public function getApiErrorCode(): ApiErrorCode;

    public function getHttpCode(): int;
}
