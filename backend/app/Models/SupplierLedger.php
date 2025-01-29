<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Supplier;
use App\Models\Purchase;

class SupplierLedger extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'supplier_ledgers';

    protected $fillable = [
        'supplier_id',
        'purchase_id',
        'transaction_date',
        'type',
        'debited_amount',
        'credited_amount',
        'description',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }
}
