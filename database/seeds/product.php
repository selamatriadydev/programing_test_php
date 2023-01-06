<?php

use App\Product as AppProduct;
use Illuminate\Database\Seeder;

class product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        array_push($data, array(
            'productID' => '00001',
            'itemTypeID' => '00001',
            'name' => 'Design',
            'stock' => 5,
            'price' => "230.00"
        ));

        array_push($data, array(
            'productID' => '00002',
            'itemTypeID' => '00001',
            'name' => 'Development',
            'stock' => 5,
            'price' => "330.00"
        ));

        array_push($data, array(
            'productID' => '00003',
            'itemTypeID' => '00001',
            'name' => 'Mettings',
            'stock' => 5,
            'price' => "60.00"
        ));

        foreach ($data as $item) {
            AppProduct::create($item);
        }
    }
}
