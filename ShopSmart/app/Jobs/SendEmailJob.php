<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //for handling background jobs
        $data = array('name'=>"simran");
   
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('gurmeetjosan595@gmail.com', 'Simran')->subject
                ('Laravel Job Scheduling Testing Mail');
            $message->from('simranjeetkaur7898@gmail.com','simran');
        });
    }
}
