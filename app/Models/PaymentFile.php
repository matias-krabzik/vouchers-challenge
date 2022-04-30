<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentFile extends Model
{
    use HasFactory;
    protected $table = "payment_files";

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function paymentFileStatus(): BelongsTo
    {
        return $this->belongsTo(PaymentFileStatus::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class);
    }
}
