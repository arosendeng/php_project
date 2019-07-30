<?php

use Illuminate\Database\Seeder;

class MerchantCatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Support\Facades\DB::table('merchant_cat')->delete();
        for($i = 0; $i < 3; $i++ ){
            \Illuminate\Support\Facades\DB::table('merchant_cat')->insert(
                [
                    'cat_name' => 'CAT'.$i,
                    'desc' => 'desc_'.$i,
                    'order' => $i,
                    'parent_id' => null
                ]
            );
        }

    }
}
