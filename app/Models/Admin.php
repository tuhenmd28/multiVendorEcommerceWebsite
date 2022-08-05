<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';

    public function viewPorsonal()
    {
        return $this->belongsTo('App\Models\vendor','vendor_id');
    }
    public function viewBusiness()
    {
        return $this->belongsTo('App\Models\VendorsBusinessDetail','vendor_id');
    }
    public function viewBank()
    {
        return $this->belongsTo('App\Models\VendorsBankDetail','vendor_id');
    }
}
