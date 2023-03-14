<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoteOut extends Model
{
    use HasFactory;

    protected $table = 'note_outs';
    protected $fillable = [
        'sell_id',
        'note_id'
    ];

    public function sell(): BelongsTo
    {
        return $this->belongsTo(Sell::class, 'sell_id');
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id');
    }
}
