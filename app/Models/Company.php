<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $table = "companies";

    protected $guarded = [];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, "company_id");
    }

    public function paymentFiles(): HasMany
    {
        return $this->hasMany(PaymentFile::class, "company_id");
    }

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class, "company_id");
    }
}
