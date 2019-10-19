<?php

namespace Tests\Feature;

use App\Todo;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_a_new_todo()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $response = $this->post('todo', [
            'body' => 'Some task to be done',
            'due' => Carbon::now(),
        ]);
        $response->assertStatus(201);
        $this->assertCount(1, Todo::all());
        $this->assertDatabaseHas('todos', [
            'body' => 'Some task to be done',
            'due' => Carbon::now(),
        ]);
    }

    /** @test */
    public function an_unauthorised_user_cannot_add_a_new_todo()
    {
        $this->withExceptionHandling();
        $response = $this->post('todo', [
            'body' => 'Some task to be done',
            'due' => Carbon::now(),
        ]);
        $response->assertStatus(302);
        $this->assertCount(0, Todo::all());
        $this->assertDatabaseMissing('todos', [
            'body' => 'Some task to be done',
            'due' => Carbon::now(),
        ]);
    }
}
