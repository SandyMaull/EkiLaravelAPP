<?php

namespace Database\Seeders;

use App\Models\Item\Item;
use App\Models\Item\KodeBarang;
use App\Models\Item\Kywn_Code;
use App\Models\Item\Merk;
use App\Models\Sell;
use Illuminate\Database\Seeder;

class DatabaseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kywn = Kywn_Code::findOrFail(1);

        $merk = Merk::create([
            'name' => 'TITAN'
        ]);

        $code_item = KodeBarang::create([
            'merk_id' => $merk->id,
            'code' => 'TT' . rand(300, 999)
        ]);
        $item = Item::create([
            'kode_barang_id' => $code_item->id,
            'quantity' => 12,
            'kywn_code_id' => $kywn->id,
            'desc' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit"
        ]);
        Sell::create([
            'item_id' => $item->id,
            'quantity' => 6,
            'kywn_code_id' => $kywn->id,
            'status' => 'Terjual'
        ]);
    }
}
