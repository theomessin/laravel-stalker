<?php

namespace Theomessin\Stalker\Tests\Feature;

use Theomessin\Stalker\Request;
use Theomessin\Stalker\Tests\TestCase;

class StalkerTest extends TestCase
{
    /** @test */
    public function it_saves_request_for_staked_route()
    {
        // Act: visit the route.
        $this->post('stalked');

        // Find the created Request.
        $requst = Request::firstOrFail();

        // Assert: a request model was created.
        $this->assertEquals('http://localhost/stalked', $requst->url);
        $this->assertEquals('POST', $requst->method);
        $this->assertEquals('127.0.0.1', $requst->ip_address);
    }
}
