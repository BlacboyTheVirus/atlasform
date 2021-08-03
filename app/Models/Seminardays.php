<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seminardays extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'seminarday',
    ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
