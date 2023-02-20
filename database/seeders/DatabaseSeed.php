<?php

namespace Database\Seeders;

use App\Models\Item\Kywn_Code;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kywn = Kywn_Code::create([
            'name' => 'Owner',
        ]);


        User::create([
            'name' => 'Ujank Gaming',
            'no_telp' => '088811112222',
            'password' => Hash::make('ujankgaming'),
            'kywn_id' => $kywn->id
        ]);
    }
}
