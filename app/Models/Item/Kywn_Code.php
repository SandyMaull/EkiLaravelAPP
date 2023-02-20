<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kywn_Code extends Model
{
    use HasFactory;

    protected $table = 'kywn__codes';
    protected $fillable = [
        'name'
    ];
}
