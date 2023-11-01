<?php

namespace Cp\Membership\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPackageOrder extends Model
{
    use HasFactory;

    public function payments()
    {
        return $this->hasMany(MembershipOrderPayment::class, 'order_id');
        # code...
    }

    public function due()
    {
        return $this->final_price - $this->payments()->sum('paid_amount');
        # code...
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(MembershipPackage::class, 'membership_package_id');
    }
}
