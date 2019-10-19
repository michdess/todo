<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
	use RefreshDatabase;
	/** @test */
	public function a_todo_has_a_body()
	{
		$todo = create('App\Todo', ['body' => 'Some task to be done']);
		$this->assertEquals('Some task to be done', $todo->fresh()->body);
	}
	/** @test */
	public function a_todo_has_a_due_date()
	{
		$due = Carbon::now();
		$todo = create('App\Todo', ['due' => $due]);
		$this->assertEquals($due, $todo->fresh()->due);
	}
	/** @test */
	public function a_todo_has_a_completion_status()
	{
		$completed = Carbon::now();
		$todo = create('App\Todo', ['completed' => $completed]);
		$this->assertEquals($completed, $todo->fresh()->completed);
	}
}
