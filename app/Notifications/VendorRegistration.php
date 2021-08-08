<?php

namespace App\Notifications;

use App\Models\Vendor;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VendorRegistration extends Notification
{
    use Queueable;
    private $registrationData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($registrationData)
    {
        $this->registrationData = $registrationData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     * 
     */
    public function toMail($notifiable)
    {
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

    
        return (new MailMessage)
                    ->subject('Atlas Virtual Show Vendor Registration')
                    ->greeting('Dear '.$this->registrationData['company'].',')
                    ->line('Thank you for registering for the Atlas Virtual Show 2021.')
                    ->line('Find attached a PDF copy of your registration details.')
                    ->attachData($pdf->output(), $this->registrationData['company']."-".$this->registrationData['vendor_code'].".pdf")
                    ->cc('michael.habib@atlastrailer.com');


    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            
        ];
    }
}
