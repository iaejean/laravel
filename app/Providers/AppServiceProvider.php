<?php

declare(strict_types=1);

namespace App\Providers;

use App\Console\Commands\SendPost;
use App\Jobs\RequestWasReceived;
use App\Services\PostService;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SendPost::class, fn () => new SendPost());

        $this->app->singleton(PostService::class, fn ($app) => new PostService(new Client(), env('URL_REQUEST')));

        $this->app->bindMethod(RequestWasReceived::class.'@handle', fn (RequestWasReceived $job, Application $app) =>
            $job->handle($app->make(PostService::class))
        );
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception
        });
    }
}
