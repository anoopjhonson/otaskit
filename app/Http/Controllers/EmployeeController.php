<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function create()
    {
        return view('employees.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'mobile_no' => 'required|string',
            'department' => 'required|string',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'mobile_no' => 'required|string',
            'department' => 'required|string',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function employeeTasks(Employee $employee)
    {
        $tasks = Task::where('assigned_to', $employee->id)->get();
        return view('employees.tasks', compact('employee', 'tasks'));
    }

    
    public function filterTasks(Request $request)
    {
        $request->validate([
            'assignee' => 'required|exists:employees,id',
            'status' => 'required|in:Unassigned,Assigned,In Progress,Done',
        ]);

        $tasks = Task::where('assigned_to', $request->input('assignee'))
            ->where('status', $request->input('status'))
            ->get();

        $employee = Employee::findOrFail($request->input('assignee'));

        return view('employees.tasks', compact('employee', 'tasks'));
    }
}