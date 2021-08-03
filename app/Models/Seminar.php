<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seminar extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',                                
        'seminarCount',
        'seminarName',
        'seminarEmail',
        'seminarPhone',
    ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    
}
