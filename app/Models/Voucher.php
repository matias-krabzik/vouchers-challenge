<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voucher extends Model
{
    use HasFactory;

    protected $table = "vouchers";

    protected $guarded = [];

    public function bookings(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function gsaOrganization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, "gsa_organization_id");
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    public function paymentFile(): BelongsTo
    {
        return $this->belongsTo(PaymentFile::class);
    }
}
