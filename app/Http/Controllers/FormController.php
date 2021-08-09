<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Notifications\VendorRegistration;

use Barryvdh\DomPDF\Facade as PDF;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



class FormController extends Controller
{
    public function index(){
        $data =  [ 'LoggedVendorInfo' => Vendor::where('id', '=', session('LoggedVendor'))->first() ];

        $form = Form::where('vendor_id', '=', session('LoggedVendor'))->first();

        if ($form) {
            return redirect()->route('print');
        } else {
            return view ('form', $data);
        }
        
    }



    public function edit(){

        $vendor = Vendor::where('id', '=', session('LoggedVendor'))->first();

        $addsem = 0;
        $regamount = 500;
        $freeusers = 0;
        if ($vendor->plan->plan == "A"){
            $addsem = 2;
            $regamount = 2000;
            $freeusers = 0;
        } else if ($vendor->plan->plan == "B") {
            $addsem = 1;
            $regamount = 1000;
            $freeusers = 1;
        }


            return view ( 'edit', 
                        [
                            'companyName'       => $vendor->name,
                            'address'           => $vendor->form->address,
                            'country'           => $vendor->form->country,
                            'state'             => $vendor->form->state,
                            'city'              => $vendor->form->city,
                            'zipcode'           => $vendor->form->zipcode,
                            'primaryContact'    => $vendor->form->primaryContact,
                            'primaryEmail'      => $vendor->form->primaryEmail,
                            'primaryTelephone'  => $vendor->form->primaryTelephone,
                            'primaryMobile'     => $vendor->form->primaryMobile,
                            'primaryFax'        => $vendor->form->primaryFax, 

                            'plan'              => $vendor->plan->plan,
                            'discount'          => $vendor->plan->discount,
                            'discountAdditional'=> $vendor->plan->discountAdditional,
                            'dating'            => $vendor->plan->dating,
                            'datingOthers'      => $vendor->plan->datingOthers."",
                            'showBuy1'          => $vendor->plan->showBuy1,
                            'showBuy2'          => $vendor->plan->showBuy2,
                            'incentive'         => $vendor->plan->incentive,    
                            'incentiveOthers'   => $vendor->plan->incentiveOthers."",
                            'promoFlyer'        => $vendor->plan->promoFlyer,
                            'promoflyerPages'   => $vendor->plan->promoflyerPages+0,
                            'brandRecognition'  => $vendor->plan->brandRecognition,

                            'participants'      => $vendor->participants,
                            
                            'hotbuys'           => $vendor->hotbuys,

                            'freeproducts'      => $vendor->freeproducts,

                            'addsem'            => $addsem,
                            'regamount'         => $regamount,
                            'freeusers'         => $freeusers,


                            'seminardays'       => $vendor->seminardays,

                            'seminarCount'      => (isset($vendor->seminar->seminarCount)?$vendor->seminar->seminarCount:0),
                            'seminarName'       => (isset($vendor->seminar->seminarName)?$vendor->seminar->seminarName:""),
                            'seminarEmail'      => (isset($vendor->seminar->seminarEmail)?$vendor->seminar->seminarEmail:""),
                            'seminarPhone'      => (isset($vendor->seminar->seminarPhone)?$vendor->seminar->seminarPhone:""),

                            'presenters'       => $vendor->presenters
                        ]
            );

    }





    





    public function store(Request $request){
       // dd($request);
///////// Get Current Vendor
         $vendor = Vendor::where('id', '=', session('LoggedVendor'))->first();

         $addsem = 0;
        $regamount = 500;
        $freeusers = 0;

        if ($request->plan == "A"){
            $addsem = 2;
            $regamount = 2000;
            $freeusers = 0;
        } else if ($request->plan == "B") {
            $addsem = 1;
            $regamount = 1000;
            $freeusers = 1;
        }



        ///////////////////////////////////////////////////////////////
        //Save FORM
        ///////////////////////////////////////////////////////////////

        try {
                //////// update Email and Vendor Name info //////////////////////////////////////////////////
                $vendor->update([
                                    'name'      =>  $request->companyName,
                                    'email'     =>  $request->primaryEmail,
                                ]);
                
                
                
            
                //////// vendor info //////////////////////////////////////////////////
                $vendor->form()->create([
                    'address'           => $request->address,
                    'country'           => $request->country,
                    'state'             => $request->state,
                    'city'              => $request->city,
                    'zipcode'           => $request->zipCode,
                    'primaryContact'    => $request->primaryContact,
                    'primaryEmail'      => $request->primaryEmail,
                    'primaryTelephone'  => $request->primaryTelephone,
                    'primaryMobile'     => $request->primaryMobile."",
                    'primaryFax'        => $request->primaryFax."",     
                ]);


                ///////// Save Plan Level and info ///////////////////////////////////////
                $vendor->plan()->create([
                    'plan'              => $request->plan,
                    'discount'          => $request->discount,
                    'discountAdditional'=> $request->discountAdditional,
                    'dating'            => $request->dating,
                    'datingOthers'      => $request->datingOthers."",
                    'showBuy1'          => $request->showBuy1,
                    'showBuy2'          => $request->showBuy2,
                    'incentive'         => $request->incentive,    
                    'incentiveOthers'   => $request->incentiveOthers."",
                    'promoFlyer'        => $request->promoFlyer,
                    'promoflyerPages'   => $request->promoflyerPages+0,
                    'brandRecognition'  => $request->brandRecognition,
                ]);    


                //////// Save Additional Participants ///////////////////////////////
                if (isset($request->participantsName)){

                    $pname = $request->participantsName;
                    $pemail = $request->participantsEmail;
                    $pmobile = $request->participantsMobile;
                    $participantsData = [];
                    

                    foreach( $pname as $key => $value ) {
                        $participantsData[$key]['participantsName'] = $value;
                        $participantsData[$key]['participantsEmail'] = $pemail[$key];
                        $participantsData[$key]['participantsMobile'] = $pmobile[$key];
                    }
                    $vendor->participants()->createMany($participantsData);

                }



                //////// Save Hot Buys /////////////////////////////////////////// 

                if (isset($request->hotbuysVendor)) {
                    $hotbuysVendor = $request->hotbuysVendor;
                    $hotbuysDescription = $request->hotbuysDescription;
                    $hotbuysNetcost = $request->hotbuysNetcost;
                    $hotbuysData = [];
                    
                    foreach ($hotbuysVendor as $key => $value) {
                        $hotbuysData[$key]['hotbuysVendor'] = $value;
                        $hotbuysData[$key]['hotbuysDescription'] = $hotbuysDescription[$key];
                        $hotbuysData[$key]['hotbuysNetcost'] = $hotbuysNetcost[$key];
                    }
                    $vendor->hotbuys()->createMany($hotbuysData);
                }




                //////// Save Free Products  /////////////////////////////////////////// 

                if (isset($request->freeProducts)) {
                    $freeproducts = $request->freeProducts;
                    $freeProductsData = [];
                    
                    foreach ($freeproducts as $key => $value) {
                        $freeProductsData[$key]['freeProducts'] = $value;
                    }
                    $vendor->freeproducts()->createMany($freeProductsData);
                }





                //////// Save Seminar info //////////////////////////////////////////////
                if($request->plan != "C") {

                    $vendor->seminar()->create([
                        'seminarCount'      => $request->seminarCount,
                        'seminarName'       => $request->seminarName,
                        'seminarEmail'      => $request->seminarEmail,
                        'seminarPhone'      => $request->seminarPhone,
                    ]);

                }
                



                //////// Save Seminar Days /////////////////////////////////////////// 
                if (isset($request->seminardays)) {
                    $seminardays = $request->seminardays;
                    $seminardaysData = [];
                    
                    foreach ($seminardays as $key => $value) {
                        $seminardaysData[$key]['seminarday'] = $value;
                    }
                    $vendor->seminardays()->createMany($seminardaysData);
                }



                ///////// Save Additional Seminar Presenters /////////////////////////////////////////// 
                if (isset($request->seminarAddName)) {
                    $seminarAddName = $request->seminarAddName;
                    $seminarAddEmail = $request->seminarAddEmail;
                    $seminarAddMobile = $request->seminarAddMobile;
                    $presentersData = [];
                    
                    foreach ($seminarAddName as $key => $value) {
                        $presentersData[$key]['seminarAddName'] = $value;
                        $presentersData[$key]['seminarAddEmail'] = $seminarAddEmail[$key];
                        $presentersData[$key]['seminarAddMobile'] = $seminarAddMobile[$key];
                    }
                    $vendor->presenters()->createMany($presentersData);
                }

            
            // CREATE PDF AND MAIL

                $registrationData = [
                    'vendor_code'      => $vendor->vendor_code,
                    'company'         =>  $vendor->name,
                ];

             //  $vendor->notify(new VendorRegistration($registrationData));    

///////////////////////////////////////////////////////////////////////////////////////////

                $pdf = PDF::loadView('mails', [
                    'companyName'       => $vendor->name,
                    'address'           => $vendor->form->address,
                    'country'           => $vendor->form->country,
                    'state'             => $vendor->form->state,
                    'city'              => $vendor->form->city,
                    'zipcode'           => $vendor->form->zipcode,
                    'primaryContact'    => $vendor->form->primaryContact,
                    'primaryEmail'      => $vendor->form->primaryEmail,
                    'primaryTelephone'  => $vendor->form->primaryTelephone,
                    'primaryMobile'     => $vendor->form->primaryMobile,
                    'primaryFax'        => $vendor->form->primaryFax, 

                    'plan'              => $vendor->plan->plan,
                    'discount'          => $vendor->plan->discount,
                    'discountAdditional'=> $vendor->plan->discountAdditional,
                    'dating'            => $vendor->plan->dating,
                    'datingOthers'      => $vendor->plan->datingOthers."",
                    'showBuy1'          => $vendor->plan->showBuy1,
                    'showBuy2'          => $vendor->plan->showBuy2,
                    'incentive'         => $vendor->plan->incentive,    
                    'incentiveOthers'   => $vendor->plan->incentiveOthers."",
                    'promoFlyer'        => $vendor->plan->promoFlyer,
                    'promoflyerPages'   => $vendor->plan->promoflyerPages+0,
                    'brandRecognition'  => $vendor->plan->brandRecognition,

                    'participants'      => $vendor->participants,
                    
                    'hotbuys'           => $vendor->hotbuys,

                    'freeproducts'      => $vendor->freeproducts,

                    'addsem'            => $addsem,
                    'regamount'         => $regamount,
                    'freeusers'         => $freeusers,

                    'seminardays'       => $vendor->seminardays,

                    'seminarCount'      => (isset($vendor->seminar->seminarCount)?$vendor->seminar->seminarCount:0),
                    'seminarName'       => (isset($vendor->seminar->seminarName)?$vendor->seminar->seminarName:""),
                    'seminarEmail'      => (isset($vendor->seminar->seminarEmail)?$vendor->seminar->seminarEmail:""),
                    'seminarPhone'      => (isset($vendor->seminar->seminarPhone)?$vendor->seminar->seminarPhone:""),

                    'presenters'       => $vendor->presenters
                ]);



                file_put_contents($vendor->name.".pdf", $pdf->output());        

                //Load Composer's autoloader
                require base_path('vendor/autoload.php');

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                // $mail->isSMTP();                                            //Send using SMTP
                // $mail->Host       = 'smtp.googlemail.com';                     //Set the SMTP server to send through
                // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                // $mail->Username   = '';                     //SMTP username
                // $mail->Password   = '';                               //SMTP password
                // $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('info@atlasvirtualshow.com', 'Atlas Virtual Show Admin');
                $mail->addAddress($vendor->email, $vendor->name);     //Add a recipient
                // $mail->addReplyTo('info@example.com', 'Information');
                $mail->addBCC('michael.habib@atlastrailer.com', "Michael Habib");

                //Attachments
                $mail->addAttachment($vendor->name.".pdf", $vendor->name."_".$vendor->vendor_code.".pdf");    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Atlas Virtual Show 2021 Registration';
                $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="color-scheme" content="light">
                <meta name="supported-color-schemes" content="light">
                <style>
                @media  only screen and (max-width: 600px) {
                .inner-body {
                width: 100% !important;
                }

                .footer {
                width: 100% !important;
                }
                }

                @media  only screen and (max-width: 500px) {
                .button {
                width: 100% !important;
                }
                }
                </style>
                </head>    

                <body style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;">

                <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;">
                <tr>
                <td align="center" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative;">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;">
                <tr>
                <td class="header" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; padding: 25px 0; text-align: center;">
                <a href="https://atlasvirtualshow.ca/form2021" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; color: #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; display: inline-block;">
                Atlas Virtual Show
                </a>
                </td>
                </tr>

                <!-- Email Body -->
                <tr>
                <td class="body" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%;">
                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;">
                <!-- Body content -->
                <tr>
                <td class="content-cell" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; max-width: 100vw; padding: 32px;">
                <h1 style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;">
                        
                        Dear '.$vendor->form->primaryContact.',</h1>
                        
                <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                        
                        Thank you for registering for the Atlas Virtual Show 2021.
                </p>
                <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                        
                        Find attached a PDF copy of your registration details.
                </p>
                <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                        
                        Regards,<br>
                        Atlas Virtual Show
                </p>


                </td>
                </tr>
                </table>
                </td>
                </tr>

                <tr>
                <td style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative;">
                <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
                <tr>
                <td class="content-cell" align="center" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; max-width: 100vw; padding: 32px;">
                <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;">© 2021 Atlas Virtual Show. All rights reserved.</p>

                </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                </body>
                </html>';


                $mail->AltBody = '[Atlas Virtual Show](https://atlasvirtualshow.ca/form2021)

                # Dear '. $vendor->form->primaryContact.'Ray Delgado,

                Thank you for registering for the Atlas Virtual Show 2021.

                Find attached a PDF copy of your registration details.

                Regards,
                Atlas Virtual Show

                © 2021 Atlas Virtual Show. All rights reserved.';

                $mail->send();

                unlink($vendor->name.".pdf");


                return redirect()->route('print')
                ->with('success', "Your registration has been submitted. 
                                Kindly check your email or click print for your copy.");


                } catch (Exception $e) {

                return redirect()
                            ->back()->withInput()
                            ->with('error', "We are sorry something went wrong. Please check your details and try again.");

                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }



/////////////////////////////////////////////////////////////////////////////////////////////




                return redirect()->route('print')
                                                ->with('success', "Your registration has been submitted. 
                                                                    Kindly check your email or click print for your copy."); 

        } catch (\Illuminate\Database\QueryException $e) {
            //dd($e);
            return redirect()
                    ->back()->withInput()
                    ->with('error', "We are sorry something went wrong. Please check your details and try again.");
        } 

       
    } //EOF Store





    public function update(Request $request){
         //dd($request);
 ///////// Get Current Vendor
          $vendor = Vendor::where('id', '=', session('LoggedVendor'))->first();


          $addsem = 0;
          $regamount = 500;
          $freeusers = 0;
          if ($request->plan == "A"){
              $addsem = 2;
              $regamount = 2000;
              $freeusers = 0;
          } else if ($request->plan == "B") {
              $addsem = 1;
              $regamount = 1000;
              $freeusers = 1;
          }
 
         ///////////////////////////////////////////////////////////////
         //Save FORM
         ///////////////////////////////////////////////////////////////
 
         try {
                 //////// update Email and Vendor Name info //////////////////////////////////////////////////
                 $vendor->update([
                                     'name'      =>  $request->companyName,
                                     'email'     =>  $request->primaryEmail,
                                 ]);
                 
                 
                 
             
                 //////// vendor info //////////////////////////////////////////////////
                 $vendor->form()->update([
                     'address'           => $request->address,
                     'country'           => $request->country,
                     'state'             => $request->state,
                     'city'              => $request->city,
                     'zipcode'           => $request->zipCode,
                     'primaryContact'    => $request->primaryContact,
                     'primaryEmail'      => $request->primaryEmail,
                     'primaryTelephone'  => $request->primaryTelephone,
                     'primaryMobile'     => $request->primaryMobile."",
                     'primaryFax'        => $request->primaryFax."",     
                 ]);
 
 
                 ///////// Save Plan Level and info ///////////////////////////////////////
                 $vendor->plan()->delete();

                 $vendor->plan()->create([
                     'plan'              => $request->plan,
                     'discount'          => $request->discount,
                     'discountAdditional'=> $request->discountAdditional,
                     'dating'            => $request->dating,
                     'datingOthers'      => $request->datingOthers."",
                     'showBuy1'          => $request->showBuy1,
                     'showBuy2'          => $request->showBuy2,
                     'incentive'         => $request->incentive,    
                     'incentiveOthers'   => $request->incentiveOthers."",
                     'promoFlyer'        => $request->promoFlyer,
                     'promoflyerPages'   => $request->promoflyerPages+0,
                     'brandRecognition'  => $request->brandRecognition,
                 ]);    
 
 
                 //////// Delete  and Add Updated Additional Participants ///////////////////////////////
                 $vendor->participants()->delete();

                 if (isset($request->participantsName)){
                     $pname = $request->participantsName;
                     $pemail = $request->participantsEmail;
                     $pmobile = $request->participantsMobile;
                     $participantsData = [];
 
                     foreach( $pname as $key => $value ) {
                         $participantsData[$key]['participantsName'] = $value;
                         $participantsData[$key]['participantsEmail'] = $pemail[$key];
                         $participantsData[$key]['participantsMobile'] = $pmobile[$key];
                     }
                     $vendor->participants()->createMany($participantsData);
 
                 }
 
 
 
                 //////// Save Hot Buys /////////////////////////////////////////// 

                 $vendor->hotbuys()->delete();
 
                 if (isset($request->hotbuysVendor)) {
                     $hotbuysVendor = $request->hotbuysVendor;
                     $hotbuysDescription = $request->hotbuysDescription;
                     $hotbuysNetcost = $request->hotbuysNetcost;
                     $hotbuysData = [];
                     
                     foreach ($hotbuysVendor as $key => $value) {
                         $hotbuysData[$key]['hotbuysVendor'] = $value;
                         $hotbuysData[$key]['hotbuysDescription'] = $hotbuysDescription[$key];
                         $hotbuysData[$key]['hotbuysNetcost'] = $hotbuysNetcost[$key];
                     }
                     $vendor->hotbuys()->createMany($hotbuysData);
                 }
 
 
 
 
                 //////// Save Free Products  /////////////////////////////////////////// 
 
                 $vendor->freeproducts()->delete();

                 if (isset($request->freeProducts)) {
                     $freeproducts = $request->freeProducts;
                     $freeProductsData = [];
                     
                     foreach ($freeproducts as $key => $value) {
                         $freeProductsData[$key]['freeProducts'] = $value;
                     }
                     $vendor->freeproducts()->createMany($freeProductsData);
                 }
 
 
 
 
 
                 //////// Save Seminar info //////////////////////////////////////////////
                 $vendor->seminar()->delete();

                 if($request->plan != "C") {
 
                     $vendor->seminar()->updateOrCreate([
                         'seminarCount'      => $request->seminarCount,
                         'seminarName'       => $request->seminarName,
                         'seminarEmail'      => $request->seminarEmail,
                         'seminarPhone'      => $request->seminarPhone,
                     ]);
 
                 }
                 
 
 
 
                 //////// Save Seminar Days /////////////////////////////////////////// 
                 $vendor->seminardays()->delete();
                 
                 if (isset($request->seminardays)) {
                     $seminardays = $request->seminardays;
                     $seminardaysData = [];
                     
                     foreach ($seminardays as $key => $value) {
                         $seminardaysData[$key]['seminarday'] = $value;
                     }
                     $vendor->seminardays()->createMany($seminardaysData);
                 }
 
 
 
                 ///////// Save Additional Seminar Presenters /////////////////////////////////////////// 
                 $vendor->presenters()->delete();
                 
                 if (isset($request->seminarAddName)) {
                     $seminarAddName = $request->seminarAddName;
                     $seminarAddEmail = $request->seminarAddEmail;
                     $seminarAddMobile = $request->seminarAddMobile;
                     $presentersData = [];
                     
                     foreach ($seminarAddName as $key => $value) {
                         $presentersData[$key]['seminarAddName'] = $value;
                         $presentersData[$key]['seminarAddEmail'] = $seminarAddEmail[$key];
                         $presentersData[$key]['seminarAddMobile'] = $seminarAddMobile[$key];
                     }
                     $vendor->presenters()->createMany($presentersData);
                 }
 
             
             // CREATE PDF AND MAIL
 
                    $registrationData = [
                        'vendor_code'      => $vendor->vendor_code,
                        'company'         =>  $vendor->name,
                    ];
 
////////////////////////////////////////////////////////////////////////////////////
                // $vendor->notify(new VendorRegistration($registrationData));    

                $pdf = PDF::loadView('mails', [
                    'companyName'       => $vendor->name,
                    'address'           => $vendor->form->address,
                    'country'           => $vendor->form->country,
                    'state'             => $vendor->form->state,
                    'city'              => $vendor->form->city,
                    'zipcode'           => $vendor->form->zipcode,
                    'primaryContact'    => $vendor->form->primaryContact,
                    'primaryEmail'      => $vendor->form->primaryEmail,
                    'primaryTelephone'  => $vendor->form->primaryTelephone,
                    'primaryMobile'     => $vendor->form->primaryMobile,
                    'primaryFax'        => $vendor->form->primaryFax, 
        
                    'plan'              => $vendor->plan->plan,
                    'discount'          => $vendor->plan->discount,
                    'discountAdditional'=> $vendor->plan->discountAdditional,
                    'dating'            => $vendor->plan->dating,
                    'datingOthers'      => $vendor->plan->datingOthers."",
                    'showBuy1'          => $vendor->plan->showBuy1,
                    'showBuy2'          => $vendor->plan->showBuy2,
                    'incentive'         => $vendor->plan->incentive,    
                    'incentiveOthers'   => $vendor->plan->incentiveOthers."",
                    'promoFlyer'        => $vendor->plan->promoFlyer,
                    'promoflyerPages'   => $vendor->plan->promoflyerPages+0,
                    'brandRecognition'  => $vendor->plan->brandRecognition,
        
                    'participants'      => $vendor->participants,
                    
                    'hotbuys'           => $vendor->hotbuys,
        
                    'freeproducts'      => $vendor->freeproducts,
        
                    'addsem'            => $addsem,
                    'regamount'         => $regamount,
                    'freeusers'         => $freeusers,
        
                    'seminardays'       => $vendor->seminardays,
        
                    'seminarCount'      => (isset($vendor->seminar->seminarCount)?$vendor->seminar->seminarCount:0),
                    'seminarName'       => (isset($vendor->seminar->seminarName)?$vendor->seminar->seminarName:""),
                    'seminarEmail'      => (isset($vendor->seminar->seminarEmail)?$vendor->seminar->seminarEmail:""),
                    'seminarPhone'      => (isset($vendor->seminar->seminarPhone)?$vendor->seminar->seminarPhone:""),
        
                    'presenters'       => $vendor->presenters
                ]);
        
        
        
                file_put_contents($vendor->name.".pdf", $pdf->output());        
            
                //Load Composer's autoloader
        require base_path('vendor/autoload.php');
        
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            // $mail->isSMTP();                                            //Send using SMTP
            // $mail->Host       = 'smtp.googlemail.com';                     //Set the SMTP server to send through
            // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            // $mail->Username   = '';                     //SMTP username
            // $mail->Password   = '';                               //SMTP password
            // $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('info@atlasvirtualshow.com', 'Atlas Virtual Show Admin');
            $mail->addAddress($vendor->email, $vendor->name);     //Add a recipient
            // $mail->addReplyTo('info@example.com', 'Information');
            $mail->addBCC('michael.habib@atlastrailer.com', "Michael Habib");
        
            //Attachments
            $mail->addAttachment($vendor->name.".pdf", $vendor->name."_".$vendor->vendor_code.".pdf");    //Optional name
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Atlas Virtual Show 2021 Registration';
            $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="color-scheme" content="light">
            <meta name="supported-color-schemes" content="light">
            <style>
            @media  only screen and (max-width: 600px) {
            .inner-body {
            width: 100% !important;
            }
            
            .footer {
            width: 100% !important;
            }
            }
            
            @media  only screen and (max-width: 500px) {
            .button {
            width: 100% !important;
            }
            }
            </style>
            </head>    
            
            <body style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;">
            
            <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;">
            <tr>
            <td align="center" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative;">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;">
            <tr>
            <td class="header" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; padding: 25px 0; text-align: center;">
            <a href="https://atlasvirtualshow.ca/form2021" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; color: #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; display: inline-block;">
            Atlas Virtual Show
            </a>
            </td>
            </tr>
            
            <!-- Email Body -->
            <tr>
            <td class="body" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%;">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;">
            <!-- Body content -->
            <tr>
            <td class="content-cell" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; max-width: 100vw; padding: 32px;">
            <h1 style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;">
                        
                        Dear '.$vendor->form->primaryContact.',</h1>
                        
            <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                        
                        Thank you for registering for the Atlas Virtual Show 2021.
            </p>
            <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                        
                        Find attached a PDF copy of your registration details.
            </p>
            <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                        
                        Regards,<br>
                        Atlas Virtual Show
            </p>
            
            
            </td>
            </tr>
            </table>
            </td>
            </tr>
            
            <tr>
            <td style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative;">
            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
            <tr>
            <td class="content-cell" align="center" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; max-width: 100vw; padding: 32px;">
            <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;">© 2021 Atlas Virtual Show. All rights reserved.</p>
            
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </body>
            </html>';
            
            
            $mail->AltBody = '[Atlas Virtual Show](https://atlasvirtualshow.ca/form2021)
        
            # Dear '. $vendor->form->primaryContact.'Ray Delgado,
            
            Thank you for registering for the Atlas Virtual Show 2021.
            
            Find attached a PDF copy of your registration details.
            
            Regards,
            Atlas Virtual Show
            
            © 2021 Atlas Virtual Show. All rights reserved.';
        
            $mail->send();
        
            unlink($vendor->name.".pdf");
        
        
            return redirect()->route('print')
            ->with('success', "Your registration has been updated. 
                                Kindly check your email or click print for your copy.");
        
        
        } catch (Exception $e) {
            
            return redirect()
                            ->back()->withInput()
                            ->with('error', "We are sorry something went wrong. Please check your details and try again.");
            
           // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }



                 
//////////////////////////////////////////////////////////////////////////                 
 
 
 
        return redirect()->route('print')
                                                 ->with('success', "Your registration details have been updated. 
                                                                     Kindly check your email or click print for your copy."); 
 
         } catch (\Illuminate\Database\QueryException $e) {
             //dd($e);
             return redirect()
                     ->back()->withInput()
                     ->with('error', "We are sorry something went wrong. Please check your details and try again.");
         } 
 
        
     } //EOF UPDATE




  
}
