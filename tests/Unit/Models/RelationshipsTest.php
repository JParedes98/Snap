<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\File;
use App\Models\Link;
use App\Models\User;
use App\Models\Snippet;
use Illuminate\Database\Eloquent\Collection;

class RelationshipsTest extends TestCase
{
    // USER RELATIONSHIPS
    public function test_user_has_multiple_files()
    {
        $user = new User();
        $this->assertInstanceOf(Collection::class, $user->files);
    }

    public function test_user_has_multiple_snippets()
    {
        $user = new User();
        $this->assertInstanceOf(Collection::class, $user->snippets);
    }

    public function test_user_has_multiple_links()
    {
        $user = new User();
        $this->assertInstanceOf(Collection::class, $user->links);
    }


    // FILES RELATIONSHIOPS
    public function test_file_belongs_to_user()
    {
        $user = User::factory()->create();
        $file = File::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $file->owner);
        $this->assertEquals($user->id, $file->user_id);
    }

    // SNIPPETS RELATIONSHIOPS
    public function test_snippet_belongs_to_user()
    {
        $user = User::factory()->create();
        $snippet = Snippet::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $snippet->owner);
        $this->assertEquals($user->id, $snippet->user_id);
    }

    // LINKS RELATIONSHIOPS
    public function test_link_belongs_to_user()
    {
        $user = User::factory()->create();
        $link = Link::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $link->owner);
        $this->assertEquals($user->id, $link->user_id);
    }
}
