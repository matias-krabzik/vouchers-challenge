<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoucherStatus extends Model
{
    use HasFactory;
    protected $table = "voucher_status";

    protected $guarded = [];

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class);
    }
}
