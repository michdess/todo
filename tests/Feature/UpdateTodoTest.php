<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_update_a_todos_body()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $todo = create('App\Todo', ['body' => 'Some task to complete']);
        $response = $this->patch('todo/'.$todo->id, [
            'body' => 'Some AMAZING task to complete',
            'due' => Carbon::now()->addDays(2),
        ]);
        $response->assertStatus(200);
        $this->assertEquals('Some AMAZING task to complete', $todo->fresh()->body);
        $this->assertEquals(Carbon::now()->addDays(2), $todo->fresh()->due);
    }

    /** @test */
    public function an_unauthorised_user_cannot_update_a_todo()
    {
        $this->withExceptionHandling();
        $due = Carbon::now();
        $todo = create('App\Todo', ['body' => 'Some task to complete', 'due' => $due]);
        $response = $this->patch('todo/'.$todo->id, [
            'body' => 'Some AMAZING task to complete',
            'due' => Carbon::now()->addDays(2),
        ]);
        $response->assertStatus(302);
        $this->assertEquals('Some task to complete', $todo->fresh()->body);
        $this->assertEquals($due, $todo->fresh()->due);
    }
}
