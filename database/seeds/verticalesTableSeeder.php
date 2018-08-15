<?php

use Illuminate\Database\Seeder;

class verticalsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('verticals')->delete();
        $countries = array(
            array('vertical' => 'Sweepstakes', 'description' => 'Sweepstakes will allow users to win something.'),
            array('vertical' => 'Female Nutra', 'description' => 'Nutra is all about Weight Loss, Beauty, Health and Fitness.'),
            array('vertical' => 'Male Nutra', 'description' => 'Nutra is all about Weight Loss, Beauty, Health and Fitness.'),
            array('vertical' => 'Mature Nutra', 'description' => 'Nutra is all about Weight Loss, Beauty, Health and Fitness.'),
            array('vertical' => 'Travel', 'description' => ''),
            array('vertical' => 'Dating', 'description' => ''),
            array('vertical' => 'Gaming', 'description' => ''),
            array('vertical' => 'Education', 'description' => ''),
            array('vertical' => 'Crypto', 'description' => ''),
            array('vertical' => 'E-Business & E-Marketing', 'description' => ''),
            array('vertical' => 'Self Help', 'description' => ''),
            array('vertical' => 'Pollitics', 'description' => '')
        );
        DB::table('verticals')->insert($countries);
    }
}


