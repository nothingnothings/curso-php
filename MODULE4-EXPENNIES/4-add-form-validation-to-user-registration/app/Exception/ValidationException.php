<?php declare(strict_types=1);

namespace App\Exception;

class ValidationException extends \RuntimeException
{
    /**
     * Undocumented function
     *
     * @param [type] $errors
     */
    public function __construct(
        public readonly array $errors,
        string $message = 'Validation Error(s)',
        int $code = 422,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
