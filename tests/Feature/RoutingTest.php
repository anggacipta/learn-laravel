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

    public function testProductRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');

        $this->get('/products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/1/item/xxx')
            ->assertSeeText('Product 1, Item xxx');

        $this->get('/products/2/item/xxx')
            ->assertSeeText('Product 2, Item yyy');
    }

    public function testRouteParameterRegex()
    {
        $this->get('categories/1234')
        ->assertSeeText('Category : 1234');

        $this->get('categories/salah')
            ->assertSeeText('Not found page');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/angga')
            ->assertSeeText('User angga');

        $this->get('/users/')
            ->assertSeeText('User 404');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/angga')
            ->assertSeeText('Conflict angga');

        $this->get('/conflict/angga')
            ->assertSeeText('Conflict Angga Cipta Pranata');
    }
}
