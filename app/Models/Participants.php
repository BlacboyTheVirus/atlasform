<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participants extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'participantsName',
        'participantsEmail',
        'participantsMobile',
    ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
