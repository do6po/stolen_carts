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

    protected function jsonPost($uri, array $data = [], array $headers = [])
    {
        return $this->json('post', $uri, $data, $headers);
    }

    protected function jsonGet($uri, array $data = [], array $headers = [])
    {
        return $this->json('get', $uri, $data, $headers);
    }

    protected function jsonDelete($uri, array $data = [], array $headers = [])
    {
        return $this->json('delete', $uri, $data, $headers);
    }

    protected function jsonPut($uri, array $data = [], array $headers = [])
    {
        return $this->json('delete', $uri, $data, $headers);
    }
}
