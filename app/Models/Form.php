<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory;
    
    protected $fillable = [
                            'vendor_id',
                            'address',
                            'country',
                            'state',
                            'city',
                            'zipcode',
                            'primaryContact',
                            'primaryEmail',
                            'primaryTelephone',
                            'primaryMobile',
                            'primaryFax',
                        ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

}



