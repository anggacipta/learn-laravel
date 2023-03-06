<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('Hello Angga Cipta');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/tidakada')->
            assertSeeText('Not found page');

        $this->get('/tidakadamas')->
        assertSeeText('Not found page');

        $this->get('/oraonok')->
        assertSeeText('Not found page');
    }
}
