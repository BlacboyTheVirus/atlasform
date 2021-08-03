<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Vendor;
use Illuminate\Http\Request;



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

    public function store(Request $request){
       // dd($request);
///////// Get Current Vendor
         $vendor = Vendor::where('id', '=', session('LoggedVendor'))->first();

        ///////////////////////////////////////////////////////////////
        //Save FORM
        ///////////////////////////////////////////////////////////////

try {
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

    return redirect()->route('print')->with('success', "Your form has been submitted. Kindly check your email or click print for your copy."); 

} catch (\Illuminate\Database\QueryException $e) {
    //dd($e);
    return redirect()->back()->withInput()->with('error', "We are sorry something went wrong. Please check your details and try again.");
} 









       
    } //EOF Store




  
}
