<?php

namespace Theomessin\Stalker\Tests\Feature;

use Theomessin\Stalker\StalkerEntry;
use Theomessin\Stalker\Tests\TestCase;

class StalkerMiddlewareTest extends TestCase
{
    /** @test */
    public function it_creates_entry_for_staked_route()
    {
        // Act: visit the route.
        $this->post('unprotected')->assertSuccessful();

        // Find the created StalkerEntry.
        $entry = StalkerEntry::firstOrFail();

        // Assert: a entry model was created.
        $this->assertEquals('http://localhost/unprotected', $entry->url);
        $this->assertEquals('POST', $entry->method);
        $this->assertEquals('127.0.0.1', $entry->ip_address);
    }

    /** @test */
    public function it_creates_entry_with_user_for_authenticated_request()
    {
        // Act: visit the route as a user.
        $this->actingAs($this->user)->post('protected')->assertSuccessful();

        // Find the created entry.
        $entry = StalkerEntry::firstOrFail();

        // Assert: the entry stalkable is the original user.
        $this->assertTrue($entry->stalkable->is($this->user));
    }

    /** @test */
    public function it_doesnt_crash_for_redirect_response()
    {
        // Act: visit the route as a user.
        $this->post('protected')->assertRedirect();

        // Find the created entry.
        $entry = StalkerEntry::firstOrFail();

        // Assert: the entry stalkable is null.
        $this->assertNull($entry->stalkable);
    }
}
