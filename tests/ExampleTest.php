<?php

namespace Theomessin\Stalker\Tests;

use Orchestra\Testbench\TestCase;
use Theomessin\Stalker\ExampleClass;

class ExampleTest extends TestCase
{
    /** @test */
    public function it_can_be_constructed()
    {
        new ExampleClass;
    }
}
