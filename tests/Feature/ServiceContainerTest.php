<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); //new foo
        $foo2 = $this->app->make(Foo::class); //new foo

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app){
            return new Person("Angga", "Cipta");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Angga", $person1->firstName); //closure() // new Person("Angga", "Cipta")
        self::assertEquals("Angga", $person2->firstName); //closure() // new Person("Angga", "Cipta")
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app){
            return new Person("Angga", "Cipta");
        });

        $person1 = $this->app->make(Person::class); // new Person("Angga", "Cipta")
        $person2 = $this->app->make(Person::class); // return existing
        $person3 = $this->app->make(Person::class); // return existing
        $person4 = $this->app->make(Person::class); // return existing

        self::assertEquals("Angga", $person1->firstName);
        self::assertEquals("Angga", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Angga", "Cipta");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person
        $person3 = $this->app->make(Person::class); // $person
        $person4 = $this->app->make(Person::class); // $person

        self::assertEquals("Angga", $person1->firstName); // new Person("Angga", "Cipta")
        self::assertEquals("Angga", $person2->firstName); // return existing
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjections()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }
}