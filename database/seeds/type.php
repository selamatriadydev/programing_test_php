<?php

use App\Type as AppType;
use Illuminate\Database\Seeder;

class type extends Seeder
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
            'typeID' => '00001',
            'name' => 'Service'
        ));

        foreach ($data as $item) {
            AppType::create($item);
        }
    }
}
