<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks=Task::all();

        return view('welcome', [
            'task'=>$tasks
        ]);
    }

    public function store(Request $request)
    {


        $attributes=request()->validate([
            'title'=> 'required',
            'description'=> 'nullable'
        ]);

        Task::create($attributes);

        return redirect('/'); 

    }

    public function update(Request $request, Task $task)
    {
        
        $task->update(['completed' => true]);

        return redirect('/'); 
    }


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/'); 
    }

    
    public function edit($id)
    {
        $task = Task::find($id);
        return view('task.edit', compact('task'));
    }

    public function updates(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();

        return redirect('/')->with('Success', 'Task edited successfully');
    }
}