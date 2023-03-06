<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Angga');

        $this->get('/hello-again')
            ->assertSeeText('Hello Angga');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Angga');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Angga'])
            ->assertSeeText('Hello Angga');

        $this->view('hello.helloworld', ['name' => 'Angga'])
            ->assertSeeText('World Angga');
    }
}
