<?php

namespace App\Models;

use App\Models\Item\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoteCome extends Model
{
    use HasFactory;

    protected $table = 'note_comes';
    protected $fillable = [
        'item_id',
        'note_id',
        'verify'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id');
    }
}
