<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\AccountReview;
use App\Mail\Message;
use Illuminate\Support\Facades\Mail;

class MailMan implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $what, public $payload)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        switch ($this->what) {
            case 'account-review':

                break;
            case 'message':
                Mail::to($this->payload['recipient'])->send(new Message($this->payload));
                break;
        }
    }
}
