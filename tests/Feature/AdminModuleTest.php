<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminModuleTest extends TestCase
{
    public function test_get_user_no_authenticated_resources_list()
    {
        $response = $this->get('/api/admin/files');
        $response->assertStatus(401);

        $response = $this->get('/api/admin/snippets');
        $response->assertStatus(401);

        $response = $this->get('/api/admin/links');
        $response->assertStatus(401);
    }

    public function test_get_user_snippets_list()
    {
        $response = $this->get('/api/admin/snippets');

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

    public function test_get_user_links_list()
    {
        $response = $this->get('/api/admin/links');

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
