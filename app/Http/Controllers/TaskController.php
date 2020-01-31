<?php

namespace App\Http\Controllers;

use Auth;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
    	return view('welcome')->with('user', Auth::user());
    }

    // create new task page
    public function add()
    {
    	return view('add');
    }

    // post new task info
    public function create(Request $request)
    {
        Task::create([
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

    	return redirect('/');
    }

    public function edit(Task $task)
    {
        if (! Auth::check() || Auth::id() !== $task->user_id) {
            return redirect('/');
        }

        return view('edit')->with('task', $task);
    }

    public function update(Request $request, Task $task)
    {
        $task->update(['content' => $request->content]);

	    return redirect('/');
    }

    public function delete(Task $task)
    {
        $task->delete();

        return redirect('/');
    }
}
