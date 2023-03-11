<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?nama=Angga')
            ->assertSeeText('Hello Angga');

        $this->post('/input/hello', ['nama' => 'Angga'])->assertSeeText('Hello Angga');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Angga',
                'last' => 'Cipta'
            ]
        ])->assertSeeText('Hello Angga');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Angga',
                'last' => 'Cipta'
            ]
        ])->assertSeeText('name')->assertSeeText('first')
            ->assertSeeText('last')->assertSeeText('Angga')
        ->assertSeeText('Cipta');
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Samsung',
                    'price' => 3000
                ],
                [
                    'name' => 'Apple',
                    'price' => 2000
                ]
            ]
        ])->assertSeeText('Samsung')->assertSeeText('Apple');
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Angga',
            'married' => 'false',
            'birth_date' => '2000-10-11'
        ])->assertSeeText('Angga')->assertSeeText('true')->assertSeeText('2000-10-11');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'Angga',
                'middle' => 'Cipta',
                'last' => 'Pranata'
            ]
        ])->assertSeeText('Angga')->assertSeeText('Pranata')
            ->assertDontSeeText('Cipta');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
                'username' => 'Angga',
                'password' => '123456',
                'admin' => 'true'
        ])->assertSeeText('Angga')->assertSeeText('123456')
            ->assertDontSeeText('admin');
    }

    public function testMerge()
    {
        $this->post('/input/filter/merge', [
            'username' => 'Angga',
            'password' => '123456',
            'admin' => 'true'
        ])->assertSeeText('Angga')->assertSeeText('123456')
            ->assertSeeText('admin')->assertSeeText('false');
    }
}
