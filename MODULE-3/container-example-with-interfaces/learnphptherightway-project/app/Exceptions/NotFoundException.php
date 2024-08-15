<?php



declare(strict_types=1);

namespace App\Exceptions\Container;

use Psr\Container\NotFoundExceptionInterface;


class NotFoundException implements NotFoundExceptionInterface
{
    private $message;
    private $code;
    private $file;
    private $line;
    private $previous;
    private $id;
    private $level;


    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getMessage(): string
    {
        return sprintf('Identifier "%s" is not defined.', $this->id);
    }

    public function getIdentifier(): string
    {
        return $this->id;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getMessageLevel(): int
    {
        return $this->level;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function getLine(): int
    {
        return $this->line;
    }


    public function getTrace(): array
    {
        return debug_backtrace();
    }

    public function getTraceAsString(): string
    {
        return implode("\n", array_map(function ($trace) {
            return "{$trace['file']}({$trace['line']}): {$trace['function']}()";
        }, $this->getTrace()));
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }


    public function getPrevious(): \Throwable
    {
        return $this->getPrevious();
    }


}