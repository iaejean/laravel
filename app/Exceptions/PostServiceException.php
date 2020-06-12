<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

/**
 * Class PostServiceException
 * @package App\Exceptions
 */
class PostServiceException extends \Exception
{
    /**
     * PostServiceException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    private function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string $message
     * @return PostServiceException
     */
    public static function fail(string $message): PostServiceException
    {
        return new PostServiceException(sprintf('Request Failed: %s', $message));
    }
}
