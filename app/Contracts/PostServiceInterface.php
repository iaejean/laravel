<?php

declare(strict_types=1);

namespace App\Contracts;

/**
 * Interface PostServiceInterface
 */
interface PostServiceInterface
{
    /**
     * @return bool
     */
    public function sendRequest(): bool;
}
