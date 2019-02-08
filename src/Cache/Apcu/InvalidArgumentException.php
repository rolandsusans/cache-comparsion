<?php declare (strict_types = 1);

namespace Demo\Cache\Apcu;

use Exception;
use Psr\SimpleCache\InvalidArgumentException as PsrCacheInvalidArgumentException;
use Throwable;

final class InvalidArgumentException extends Exception implements PsrCacheInvalidArgumentException
{
    private function __construct(string $message = '', ?Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }

    public static function fromString(?Throwable $previous = null): self
    {
        return new self(
            '$key should be string',
            $previous
        );
    }

    public static function fromTraversable(?Throwable $previous = null): self
    {
        return new self(
            '$keys should be traversable.',
            $previous
        );
    }
}

