<?php

namespace Tests\Feature;

use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortenUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_shorten_url(): void
    {
        $this->post('/', [
            'url' => 'https://example.test'
        ])->assertRedirectToRoute('url.index');

        $this->assertDatabaseHas('short_urls', ['url' => 'https://example.test']);
    }
}
