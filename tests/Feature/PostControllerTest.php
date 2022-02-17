<?php

namespace Tests\Feature;

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $post = Post::factory()->create([
            'title' => 'Its title',
            'description' => 'Its description',
        ]); 

        // Act
        $getPosts = (new PostController)->show($post->id);

        // Assert
        $this->assertEquals($post->id, $getPosts->id);
        $this->assertEquals($post->title, $getPosts->title);
        $this->assertEquals($post->description, $getPosts->description);
    }

    /**
     * @test
     */
    public function it_trows_exception_if_wrong_id_passed()
    {
        // Arrage 
        Post::factory()->create();

        // Assert
        $this->expectException(ModelNotFoundException::class);

        // Act 
        (new PostController)->show(99);
    }


    /**
     * @test
     */
    public function it_creates_a_new_post() 
    {
        // Arrange
        $this->assertDatabaseCount('posts', 0);
        $post = [
            'title' => 'Its title',
            'description' => 'Its description'
        ];

        // Act
        (new PostController)->store($post); 

        // Assert
        $this->assertDatabaseCount('posts', 1);
    }
}
