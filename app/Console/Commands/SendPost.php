<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\RequestWasReceived;
use Illuminate\Console\Command;

/**
 * Class SendPost
 * @package App\Console\Commands
 */
final class SendPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Throw post request';

    /**
     * SendPost constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start running command');
        RequestWasReceived::dispatch()
            ->onConnection('database');
        $this->info('Finish running command');

        return;
    }
}
