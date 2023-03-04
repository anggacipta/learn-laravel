<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{
    public function test_example()
    {
        if(App::environment(['testing', 'prod', 'dev'])){
            // kode program saya
            self::assertTrue(true);
        }
    }
}
