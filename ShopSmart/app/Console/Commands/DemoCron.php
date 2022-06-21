<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Cron Mail is working fine!");
        $data = array('name'=>"simran");
   
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('gurmeetjosan595@gmail.com', 'Simranjeet Kaur')->subject
                ('Laravel Basic Testing Mail');
            $message->from('simranjeetkaur7898@gmail.com','simran');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
}
