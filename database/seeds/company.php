<?php

use App\Company as AppCompany;
use Illuminate\Database\Seeder;

class company extends Seeder
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
            'companyID' => '00001',
            'email' => 'email1@gmail.com',
            'name' => 'Discovery Design',
            'address' => '41 St Vincent Place Glasgow G1 2ER Scotland',
        ));

        foreach ($data as $item) {
            AppCompany::create($item);
        }
    }
}
