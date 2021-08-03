<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotbuys extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'hotbuysVendor',
        'hotbuysDescription',
        'hotbuysNetcost',
    ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }


}
