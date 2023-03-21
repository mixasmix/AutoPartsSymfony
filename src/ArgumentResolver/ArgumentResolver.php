<?php

namespace App\ArgumentResolver;

use App\Enum\ApiErrorCode;
use App\Exception\ApiHttpException\ApiBadRequestException;
use JsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

abstract class ArgumentResolver implements ValueResolverInterface
{
    private ArgumentMetadata $argument;

    private Request $request;

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $this->argument = $argument;
        $this->request = $request;

        return $argument->getType() !== $this->getSupportsClass() ? [] : $this->handle();
    }

    abstract public function getSupportsClass(): string;

    abstract public function handle(): iterable;

    /**
     * @return ArgumentMetadata
     */
    public function getArgument(): ArgumentMetadata
    {
        return $this->argument;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getJson(): array
    {
        $content = $this->getRequest()->getContent();

        try {
            return empty($content) ? [] : (array) json_decode(
                json: $content,
                associative: true,
                flags: JSON_THROW_ON_ERROR,
            );
        } catch (JsonException $exception) {
            throw new ApiBadRequestException(
                errors: ['Недопустимый JSON: ' . $exception->getMessage()],
                apiErrorCode: ApiErrorCode::BAD_REQUEST,
            );
        }
    }

    /**
     * @param string                     $key
     * @param string|int|bool|null|float $default
     *
     * @return string|int|bool|float|array|null
     */
    protected function get(
        string $key,
        string|int|bool|null|float|array $default = null,
    ): string|int|bool|null|float|array {
        $value = $this->getRequest()->get($key, $default);

        //костыль, иначе если в гет передать булево значение то придет строка
        if (is_string($value)) {
            return match ($value) {
                'true' => true,
                'false' => false,
                default => $value,
            };
        }

        return $value;
    }
}
