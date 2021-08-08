<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Plan;
use App\Models\Vendor;
use App\Models\Hotbuys;
use App\Models\Seminar;
use Illuminate\Http\Request;
use App\Notifications\VendorRegistration;

class PrintController extends Controller
{
    public function index(){
      
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


        return view ( 'print', 
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

}
