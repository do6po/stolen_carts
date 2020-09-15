<?php

use Dotenv\Dotenv;
use Faker\Generator;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }

    protected function setUp(): void
    {
        parent::setUp();

        Dotenv::createMutable(base_path(), '.env.testing')->load();
    }

    protected function faker(): Generator
    {
        return Faker\Factory::create();
    }
}
