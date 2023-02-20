<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $fillable = [
        'kode_barang_id',
        'seri',
        'quantity',
        'kywn_code_id',
        'verify',
        'created_at'
    ];

    public function kode_barang(): BelongsTo
    {
        return $this->belongsTo(KodeBarang::class, 'kode_barang_id');
    }

    public function kywn_code(): BelongsTo
    {
        return $this->belongsTo(Kywn_Code::class, 'kywn_code_id');
    }
}
