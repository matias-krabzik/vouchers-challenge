<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentFileStatus extends Model
{
    use HasFactory;
    protected $table = "payment_file_status";

    protected $guarded = [];

    public function paymentFiles(): HasMany
    {
        return $this->hasMany(PaymentFile::class);
    }
}
