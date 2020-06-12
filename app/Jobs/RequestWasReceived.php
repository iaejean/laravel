<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Exceptions\PostServiceException;
use App\Services\PostService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * Class RequestWasReceived
 * @package App\Jobs
 */
class RequestWasReceived implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $retryAfter = 3;
    public $maxExceptions = 3;
    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function retryUntil()
    {
        return now()->addSeconds(5);
    }

    /**
     * @param PostService $service
     */
    public function handle(PostService $service)
    {
        try {
            $service->sendRequest();
        } catch (\Exception $exception) {
            $this->failed($exception);
        }
    }

    /**
     * @param \Exception $exception
     * @throws \Exception
     */
    public function failed(\Exception $exception)
    {
        Log::warning($exception->getMessage());
        throw $exception;
    }
}
