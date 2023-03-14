<?php

namespace App\Models;

use App\Models\Item\Item;
use App\Models\Item\Kywn_Code;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sell extends Model
{
    use HasFactory;

    protected $table = 'sells';
    protected $fillable = [
        'item_id',
        'quantity',
        'kywn_code_id',
        'status'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function kywn_code(): BelongsTo
    {
        return $this->belongsTo(Kywn_Code::class, 'kywn_code_id');
    }
}
