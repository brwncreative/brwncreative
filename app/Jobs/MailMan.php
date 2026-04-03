<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\AccountReview;

class MailMan implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $what, public $client)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        switch($this->what){
            case 'account-review':
                
                break;
        }
    }
}
