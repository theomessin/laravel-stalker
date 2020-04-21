<?php

namespace Theomessin\Stalker\Tests\Feature;

use Illuminate\Foundation\Auth\User as AuthUser;
use Theomessin\Stalker\HasStalkerEntries;
use Theomessin\Stalker\Tests\TestCase;

class HasStalkerEntriesTest extends TestCase
{
    /** @test */
    public function class_with_trait_can_retrieve_stalker_entries()
    {
        $user = User::find($this->user->id);
        // Arrange: create an entry for this user.
        $this->actingAs($user)->post('protected')->assertSuccessful();

        // Act: get the Stalker entries for the user.
        $entry = $user->stalkerEntries()->firstOrFail();

        // Assert: the entry was correctly created.
        $this->assertEquals('http://localhost/protected', $entry->url);
        $this->assertEquals('POST', $entry->method);
        $this->assertEquals('127.0.0.1', $entry->ip_address);
    }
}

class User extends AuthUser
{
    use HasStalkerEntries;
}
