<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicModuleTest extends TestCase
{
    public function test_get_public_files_list()
    {
        $response = $this->get('/api/files');

        $response
            ->assertStatus(200)
            ->assertSee([
                'title',
                'name',
                'location',
                'size',
                'mime',
                'is_private',
                'user_id'
            ]);
    }

    public function test_get_public_snippets_list()
    {
        $response = $this->get('/api/snippets');

        $response
            ->assertStatus(200)
            ->assertSee([
                'title',
                'description',
                'html',
                'is_private',
                'user_id'
            ]);
    }

    public function test_get_public_links_list()
    {
        $response = $this->get('/api/links');

        $response
            ->assertStatus(200)
            ->assertSee([
                'title',
                'url',
                'open_in_new_tab',
                'is_private',
                'user_id'
            ]);
    }

}
