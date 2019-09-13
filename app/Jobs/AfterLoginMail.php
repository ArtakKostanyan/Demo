<?php

namespace App\Jobs;

use App\Mail\OsInfoMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;

class AfterLoginMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $agent;

    /**
     * Create a new job instance.
     *
     * @param \Jenssegers\Agent\Agent $agent
     */
    public function __construct( Agent $agent)
    {
       $this->agent=$agent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try{
            Mail::to(auth()->user())
                ->send(new OsInfoMail($this->agent));
        }catch (\Exception $e){

            dd($e);
        }



    }
}
