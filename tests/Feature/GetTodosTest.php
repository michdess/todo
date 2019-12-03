<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetTodosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_get_all_todos()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $todo = create('App\Todo');
        $response = $this->get('todos');
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $todo->id]);
    }

    /** @test */
    public function an_unauthorised_user_cannot_get_all_todos()
    {
        $this->withExceptionHandling();
        $todo = create('App\Todo');
        $response = $this->get('todos');
        $response->assertStatus(302);
    }
}
