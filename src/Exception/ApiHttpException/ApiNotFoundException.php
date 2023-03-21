<?php

namespace App\Exception\ApiHttpException;

use App\Enum\ApiErrorCode;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiNotFoundException extends NotFoundHttpException implements ApiExceptionInterface
{
    public function __construct(
        private readonly array $errors,
        private readonly ApiErrorCode $apiErrorCode,
        string $message = '',
        int $code = 0,
        Exception $previous = null
    ) {
        $message = empty($message) ? json_encode($errors) : $message;

        parent::__construct(
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

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return Response::HTTP_NOT_FOUND;
    }
}
