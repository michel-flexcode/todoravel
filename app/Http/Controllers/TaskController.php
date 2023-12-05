<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Make sure the user is authenticated
        if (auth()->check()) {
            // Retrieve tasks for the authenticated user
            $tasks = auth()->user()->tasks;

            // Pass tasks to the view
            return view('tasks.index', ['tasks' => $tasks]);
        }

        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // You may have additional logic for creating a new task, e.g., getting data from a model
        // For simplicity, I'm just passing an empty task object to the view
        $task = new Task;

        return view('tasks.create', ['task' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'isDone' => 'required|boolean',
        ]);

        // Create a new task with the provided data
        auth()->user()->tasks()->create([
            'description' => $request->input('description'),
            'isDone' => $request->input('isDone'),
        ]);

        // Redirect to the tasks index page
        return redirect()->route('tasks.index');
    }
}
