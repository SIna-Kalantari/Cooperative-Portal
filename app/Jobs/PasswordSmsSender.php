<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PasswordSmsSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone, $password)
    {
        // try{
        //     // $client->SendSMS($fromNum,$toNum,$messageContent,$user,$pass,$time,$op);
        //     $numd='100069183656';
        //     $tell=$data['tell'];
        //     $text=$data['code'];
        //     $br='<br/>';
        //     $txt="";
        //     $ch = curl_init();
        //     curl_setopt($ch,CURLOPT_URL,'https://api.sabanovin.com/v1/sa2536228029:9JM6XbnutIb0McEU8DhSVDKrULCYq9aFcp1H/sms/send.json');
        //     curl_setopt($ch,CURLOPT_POSTFIELDS,"gateway=$numd&to=$tell&text=$txt");
        //     curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
        //     curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //     $res = curl_exec($ch);
        //     curl_close($ch);
        // }catch(Exception $e) {
        //     return response()->json(['state' => False, 'code' => 232, 'errors' => 'مشکلی پیش آمده ، لطفا لحظاتی دیگر دوباره تلاش کنید.']);
        // }        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
