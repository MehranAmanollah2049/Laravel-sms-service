<?php

namespace App\Console\Commands;

use App\Services\Notifications\Sms\SmsService;
use Illuminate\Console\Command;

class SmsSenderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send {--phone=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SmsService $smsService)
    {
        $phone = $this->option('phone');
        $bodyId = (int)$this->ask('Enter your Pattern ID');
     
        $arguments = [];
        $isEnd = true;

        do {
            $arguments []= (string)$this->ask('Enter your Argument');

            if(!$this->confirm('Do you have more arguments?', false))
            {
                $isEnd = false;
            }

        }  while($isEnd);
       
        return dd($smsService->send($phone,$bodyId,$arguments));
        
    }
}
