<?php

namespace App\Exception\ApiHttpException;

use App\Enum\ApiErrorCode;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ApiUnauthorizedException extends UnauthorizedHttpException implements ApiExceptionInterface
{
    /**
     * Вызов
     */
    private const CHALLENGE = 'Basic realm="Access to the api", charset="UTF-8"';

    public function __construct(
        private readonly array $errors,
        private readonly ApiErrorCode $apiErrorCode,
        string $message = '',
        int $code = 0,
        Exception $previous = null
    ) {
        $message = empty($message) ? json_encode($errors) : $message;

        parent::__construct(
            challenge: self::CHALLENGE,
            message: $message,
            previous: $previous,
            code: $code,
        );
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getApiErrorCode(): ApiErrorCode
    {
        return $this->apiErrorCode;
    }

    public function getHttpCode(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }
}
