<?php

namespace App\Exception\ApiHttpException;

use App\Enum\ApiErrorCode;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiEntityNotFoundException extends NotFoundHttpException implements ApiExceptionInterface
{
    /**
     * @param array<string>  $errors
     * @param ApiErrorCode   $apiErrorCode
     * @param string         $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct(
        private readonly array $errors,
        private readonly ApiErrorCode $apiErrorCode,
        string $message = '',
        int $code = 0,
        ?Exception $previous = null
    ) {
        $message = empty($message) ? json_encode($errors) : $message;

        parent::__construct(
            message: $message,
            previous: $previous,
            code: $code,
        );
    }

    /**
     * @return array<string>
     */
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
        return Response::HTTP_BAD_REQUEST;
    }
}
