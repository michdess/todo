<?php

namespace App\Http\Controllers;

use App\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::all();
    }
    public function store()
    {
    	$todo = Todo::create(request()->all());
    	return $todo;
    }
   	public function update($id)
    {
        $todo = Todo::find($id);
        $todo->update(request()->all());
        return $todo;       
    }
    public function destroy($id)
    {
    	return Todo::destroy($id);
    }
}
