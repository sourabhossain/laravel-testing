<?php

namespace Tests\Feature;

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_shows_list_of_post()
    {
        // Arrange
        Post::factory()->count(15)->create();

        // Act 
        $posts = (new PostController)->index();

        // Assert
        $this->assertEquals(15, $posts->count());
    }

    /**
     * @test
     */
    public function it_shows_a_single_post() 
    {
        // Arrange
        $post = Post::factory()->create(); 

        // Act
        $getPosts = (new PostController)->show($post->id);

        // Assert
        $this->assertEquals($post->id, $getPosts->id);
    }
}
