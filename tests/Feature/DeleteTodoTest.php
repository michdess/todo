<?php

namespace Tests\Feature;

use App\Todo;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTodoTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_delete_a_task()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $due = Carbon::now();
        $todo = create('App\Todo',[
            'body' => 'Some task to complete',
            'due' => $due,            
        ]);
        $this->assertCount(1, Todo::all());
        $response = $this->delete('todo/'.$todo->id);
        $response->assertStatus(200);
        $this->assertCount(0, Todo::all());
        $this->assertDatabaseMissing('todos', [
            'body' => 'Some task to complete',
            'due' => $due,            
        ]);
    }
    /** @test */
    public function an_unauthorised_user_cannot_delete_a_task()
    {
        $this->withExceptionHandling();
        $due = Carbon::now();
        $todo = create('App\Todo',[
            'body' => 'Some task to complete',
            'due' => $due,            
        ]);
        $this->assertCount(1, Todo::all());
        $response = $this->delete('todo/'.$todo->id);
        $response->assertStatus(302);
        $this->assertCount(1, Todo::all());
        $this->assertDatabaseHas('todos', [
            'body' => 'Some task to complete',
            'due' => $due,            
        ]);
    }
}
