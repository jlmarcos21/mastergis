<?php

use Illuminate\Database\Seeder;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Voucher::create([
            'name'  =>  'FACTURA',
            'serie'  =>  '001',
        ]);

        App\Voucher::create([
            'name'  =>  'BOLETA',
            'serie'  =>  '002',
        ]);
    }
}
