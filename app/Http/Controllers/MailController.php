<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendmail(){
        $vendor = Vendor::where('id', '=', session('LoggedVendor'))->first();
        
        //dd ($vendor->email);
        $data["email"]=$vendor->email;
        $data["client_name"]=$vendor->name;
        $data["subject"]="SUBJECT OF MAIL";

        $pdf = PDF::loadView('mails', $data);

        try{
            Mail::send('mails', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "invoice.pdf")
            ->cc('aodeyemi@gmail.com');
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";

        }else{

           $this->statusdesc  =   "Message sent Succesfully";
           $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
 }
}
