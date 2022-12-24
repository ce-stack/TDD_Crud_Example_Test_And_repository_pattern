<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Auth;
class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_read_all_posts() {

        //create post
        $post = Post::factory()->create();

        //visit posts page
        $response = $this->get('posts.index');

        //read the description of post by user
        $response->assertSee($post->description);
    }


    public function test_a_user_can_read_single_post() {

        //create post
        $post = Post::factory()->create();

        //single post page
        $response = $this->get('posts.show/' . $post->id);

        //read the descrtiption of single post
        $response->assertSee($post->description);
    }


    public function test_auth_user_can_create_new_post() {
        //create user
        $this->actingAs(User::factory(1)->create()->first());

        //create post
        $post = Post::factory()->create();

        //post request
        $this->post('/posts.create',$post->toArray());

        //stored in DB
        $this->assertEquals(1,Post::all()->count());
    }

    public function test_unauthenticated_users_cannot_create_a_new_task() {

        $post = Post::factory()->make();
        //unauth user make request
        $this->post('posts.create' , $post->toArray())->assertStatus(405);
    }

    public  function test_auth_user_can_update_the_post() {
        //singed user
        $this->actingAs(User::factory(1)->create()->first());

        //user with the post he created
        $post = Post::create(['user_id' => Auth::user()->id , 'description' => 'desc updated']);
        //$this->description = "desc updated";

        //user hit endpoint to update the post
        $this->put('/posts/' . $post->id , $post->toArray());

        //task should update in DB
        $this->assertDatabaseHas('posts' , ['id' => $post->id , 'description' => 'desc updated']);

    }


    public function test_unauthorized_user_cannot_update_the_post() {
        //singed user
        $this->actingAs(User::factory(1)->create()->first());

        //post which is not created by the user
        $post = Post::factory()->create();

        //user hit the endpoint to update the post
        $response = $this->put('/posts/'.$post->id , $post->toArray());

        //should get error
        $response->assertStatus(500);
    }


}
