<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',                                
        'plan',
        'discount',
        'discountAdditional',
        'dating',
        'datingOthers',
        'showBuy1',
        'showBuy2',
        'incentive',
        'incentiveOthers',
        'promoFlyer',
        'promoflyerPages',
        'brandRecognition',
    ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }



            

}
