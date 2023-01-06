<?php

use Illuminate\Database\Seeder;

use function PHPSTORM_META\type;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(client::class);
        $this->call(company::class);
        $this->call(type::class);
        $this->call(product::class);
    }
}
