<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;
    protected $table = "organizations";

    protected $guarded = [];

    /**
     * Organización padre.
     * @return BelongsTo
     */
    public function organizationParent(): BelongsTo
    {
        return $this->belongsTo(Organization::class, "organization_parent_id");
    }

    /**
     * Organizaciones
     * @return HasMany
     */
    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class, "organization_parent_id");
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function gsaVouchers(): HasMany
    {
        return $this->hasMany(Voucher::class, "gsa_organization_id");
    }

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class, "organization_id");
    }

    public function paymentFiles(): HasMany
    {
        return $this->hasMany(PaymentFile::class);
    }
}
