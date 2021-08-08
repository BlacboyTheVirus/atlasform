<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Vendor;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Notifications\VendorRegistration;



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

                $vendor->notify(new VendorRegistration($registrationData));    



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
                 $vendor->plan()->update([
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
 
                 $vendor->notify(new VendorRegistration($registrationData));    
 
 
 
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
