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

/**
 * Class RequestWasReceived
 * @package App\Jobs
 */
class RequestWasReceived implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
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

    /**
     * @param PostService $service
     * @throws PostServiceException
     */
    public function handle(PostService $service)
    {
        $service->sendRequest();
    }
}
