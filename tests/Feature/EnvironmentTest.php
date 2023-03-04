<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function test_example()
    {
        $youtube = Env::get('YOUTUBE', 'Angga Cipta');

        self::assertEquals('Angga Cipta', $youtube);
    }

    public function testDefaultEnv()
    {
        $author = env('AUTHOR', 'Angga');

        self::assertEquals('Angga', $author);
    }
}
