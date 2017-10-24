<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class NewsletterCommand extends Command
{
    use NewsletterTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send {date?} {action?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends newsletter based on user preferences';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public function handle()
    {
        $today = $this->argument('date');
        if (!$today) {
            $today = new \DateTime();
        }
        $action = $this->argument('action');

        $this->handleNewsletter($today, $action);
    }
}
