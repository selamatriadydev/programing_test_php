<?php

use App\Client as AppClient;
use Illuminate\Database\Seeder;

class client extends Seeder
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
            'clientID' => '00001',
            'email' => 'email2@gmail.com',
            'name' => 'Barrington Publishers',
            'address' => '17 Great Suffolk Street London SE1 ONS United Kingdom',
        ));

        foreach ($data as $item) {
            AppClient::create($item);
        }
    }
}
