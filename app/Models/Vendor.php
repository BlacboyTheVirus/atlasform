<?php

namespace App\Models;

use App\Models\Form;
use App\Models\Plan;
use App\Models\Hotbuys;
use App\Models\Seminar;
use App\Models\Presenters;
use App\Models\Seminardays;
use App\Models\Freeproducts;
use App\Models\Participants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Vendor as Authenticatable;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'vendor_code',
    ];


    public function form(){
        return $this->hasOne(Form::class);
    }

    public function plan(){
        return $this->hasOne(Plan::class);
    }

    public function seminar(){
        return $this->hasOne(Seminar::class);
    }

    public function participants(){
        return $this->hasMany(Participants::class);
    }

    public function hotbuys(){
        return $this->hasMany(Hotbuys::class);
    }


    public function freeproducts(){
        return $this->hasMany(Freeproducts::class);
    }

    public function seminardays(){
        return $this->hasMany(Seminardays::class);
    }

    public function presenters(){
        return $this->hasMany(Presenters::class);
    }


}
