<?php

namespace App\Http\Controllers;

use App\Console\Commands\NewsletterTrait;

class NewsletterSendController extends Controller
{
    use NewsletterTrait;

    public function indexAction($action)
    {
        //fortnightly
        //weekly
        //monthly
        $date = date('Y-m-d');
        $this->handleNewsletter($date, $action);

        return;
        $output = shell_exec('php '.base_path('artisan').' newsletter:send '.$date.' '.$action);
        if (is_string($output)) {
            $output = explode("\n", $output);
        }
        foreach ($output as $value) {
            echo $value.'<br/>';
        }
    }

    public function info($arg)
    {
        echo $arg.'<br>';
    }

    public function writeln($arg)
    {
        echo $arg.'<br>';
    }
}
