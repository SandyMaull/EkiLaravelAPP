<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KodeBarang extends Model
{
    use HasFactory;

    protected $table = 'kode_barangs';
    protected $fillable = [
        'merk_id',
        'code'
    ];

    public function merk(): BelongsTo
    {
        return $this->belongsTo(Merk::class, 'merk_id');
    }
}
