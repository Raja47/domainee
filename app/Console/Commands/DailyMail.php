<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Mail;
use App\Models\Lead;
class DailyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily emails to update about recent leads added.';

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
        $leads = Lead::where('status', 1)->get();
        $leads = Lead::whereDate('created_at', Carbon::today() )->get();
        $email = 'raja.ram@abtach.org';
      
        $data= ['email' => $email , 'leads'=> $leads ];
        
        Mail::send('emails.dailymail', $data , function ($message) use ($email ){
            $message->from( $email , config('app.name').' Feedback' );
            $message->subject('Daily Leads Update');
            $message->to('rajexhkumar123@gmail.com');
        });
    
        \Log::info("Daily Web Mail Sent");
        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
