<?php

use Illuminate\Database\Seeder;
use App\domain;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new = new domain();
        $new->domain = 'premiumbooks.net';
        $new->save();
    }
}
