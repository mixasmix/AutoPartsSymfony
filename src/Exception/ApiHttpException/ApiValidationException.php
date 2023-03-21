<?php

namespace App\Exception\ApiHttpException;

use App\Enum\ApiErrorCode;
use Exception;

class ApiValidationException extends ApiBadRequestException
{
    /**
     * @param array<string>     $errors
     * @param ApiErrorCode|null $apiErrorCode
     * @param string            $message
     * @param int               $code
     * @param Exception|null    $previous
     */
    public function __construct(
        array $errors,
        ApiErrorCode $apiErrorCode = null,
        string $message = '',
        int $code = 0,
        Exception $previous = null
    ) {
        parent::__construct(
            errors: $errors,
            apiErrorCode: $apiErrorCode ?? ApiErrorCode::VALIDATION_ERROR,
            message: $message,
            code: $code,
            previous: $previous,
        );
    }
}
