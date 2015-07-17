<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory;

abstract class MasterTableSeeder extends Seeder
{

    protected $faker;

    function __construct(Faker $faker)
    {
        $this->faker = Faker::create();

        $this->initializeFactoriesPath();
    }

    protected function initializeFactoriesPath()
    {
        Factory::$factoriesPath = 'app/tests/factories';
    }

    public abstract function createSlug();
}