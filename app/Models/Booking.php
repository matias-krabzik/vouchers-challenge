<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    protected $table = "bookings";

    protected $guarded = [];

    /**
     * Usuario al que pertenece.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, "organization_id");
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, "company_id");
    }
}
