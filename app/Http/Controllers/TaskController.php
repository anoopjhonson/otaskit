<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $task = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status' => 'Unassigned', 
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    public function edit(Task $task)
{
    
    $employees = Employee::all();

    return view('tasks.edit', compact('task', 'employees'));
}

public function update(Request $request, Task $task)
{
    
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    
    $task->update([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
}

public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function index(Request $request)
    {
        $tasks = Task::query();

        
        if ($request->has('assignee')) {
            $tasks->where('employee_id', $request->input('assignee'));
        }

        
        if ($request->has('status')) {
            $tasks->where('status', $request->input('status'));
        }

        $tasks = $tasks->get();

        
        $employees = Employee::all();

        return view('tasks.index', compact('tasks', 'employees'));
    }

    public function assign(Task $task, Request $request)
    {
        
        if ($task->status === 'Unassigned' && !$task->started_at) {
      
            $task->employee_id = $request->assigned_to;
            $task->status = 'Assigned';
            $task->save();

            return redirect()->route('tasks.index')->with('success', 'Task assigned successfully.');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Task cannot be assigned. It might be already assigned or in progress.');
        }
    }

    public function start(Task $task)
    {

        if ($task->status === 'Assigned' && !$task->started_at) {
      
            $task->status = 'In Progress';
            $task->started_at = Carbon::now();
            $task->save();

            return redirect()->route('tasks.index')->with('success', 'Task started successfully.');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Task cannot be started. It might be unassigned, already in progress, or completed.');
        }
    }

    public function done(Task $task)
    {
       // echo '1111';
       //die();
        if ($task->status === 'In Progress' && $task->started_at) {
            $startTime = Carbon::parse($task->started_at);
            $currentTime = Carbon::now();
            $minutesElapsed = $currentTime->diffInMinutes($startTime);

            if ($minutesElapsed >= 5) {
             
                $task->status = 'Done';
                $task->save();

                return redirect()->route('tasks.index')->with('success', 'Task marked as done successfully.');
            } else {
                return redirect()->route('tasks.index')->with('error', 'The task cannot be marked as done. It must be at least 5 minutes since starting the task.');
            }
        } else {
            return redirect()->route('tasks.index')->with('error', 'Task cannot be marked as done. It might be unassigned, not started, or already completed.');
        }
    }

    public function changeAssignee(Task $task, Employee $employee)
{
    
    if ($task->status === 'Assigned' && !$task->started_at) {
        $task->employee_id = $employee->id;
        $task->save();
//echo '111';exit;
        return redirect()->route('tasks.index')->with('success', 'Assignee changed successfully.');
    } else {
        return redirect()->route('tasks.index')->with('error', 'Assignee cannot be changed. The task might be unassigned, in progress, or completed.');
    }
}
}