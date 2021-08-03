<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presenters extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'seminarAddName',
        'seminarAddEmail',
        'seminarAddMobile',
    ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    
}
