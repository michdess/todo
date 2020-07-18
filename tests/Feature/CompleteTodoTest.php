<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompleteTodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_mark_a_todo_as_complete()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $todo = create('App\Todo');
        $now = Carbon::now();
        $response = $this->patch('todo/'.$todo->id, ['completed' => $now]);
        $response->assertStatus(200);
        $this->assertNotNull($todo->fresh()->completed);
        $this->assertEquals($now, $todo->fresh()->completed);
    }

    /** @test */
    public function an_unauthorsed_user_cannot_mark_a_todo_as_complete()
    {
        $this->withExceptionHandling();
        $todo = create('App\Todo');
        $response = $this->patch('todo/'.$todo->id, ['completed' => Carbon::now()]);
        $response->assertStatus(302);
        $this->assertNull($todo->fresh()->completed);
    }

    /** @test */
    public function a_user_can_mark_a_completed_todo_as_incomplete()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $todo = create('App\Todo', ['completed' => Carbon::now()]);
        $response = $this->patch('todo/'.$todo->id, [
            'completed' => null,
        ]);
        $response->assertStatus(200);
        $this->assertNull($todo->fresh()->completed);
    }

    /** @test */
    public function an_unauthorised_user_cannot_mark_a_completed_todo_as_incomplete()
    {
        $this->withExceptionHandling();
        $now = Carbon::now();
        $todo = create('App\Todo', ['completed' => $now]);
        $response = $this->patch('todo/'.$todo->id, [
            'completed' => null,
        ]);
        $response->assertStatus(302);
        $this->assertNotNull($todo->fresh()->completed);
        $this->assertEquals($now, $todo->fresh()->completed);
    }
}
