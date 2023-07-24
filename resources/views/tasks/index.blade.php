@extends('layouts.app')

@section('content')
    <h2>Tasks</h2>
    <a href="{{ route('tasks.create') }}">Create Task</a>
    @if (Session::has('message'))
        <p>{{ Session::get('message') }}</p>
    @endif
    @if (Session::has('error'))
        <p style="color: red">{{ Session::get('error') }}</p>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Started At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($tasks) > 0)
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->assignedEmployee->name ?? 'Unassigned' }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->started_at }}</td>
                        <td>
                            @if ($task->status === 'Unassigned')
                                {{-- Edit******* --}}
                                <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                                {{-- delete******* --}}
                                <form action="{{ route('tasks.destroy', $task) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure to delete this task?')"
                                        class="btn btn-danger">Delete</button>
                                </form>

                                {{-- Assign******* --}}
                                <form action="{{ route('tasks.assign', $task) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <select name="assigned_to" required>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-info">Assign</button>
                                </form>
                            @elseif ($task->status === 'Assigned')
                                <form action="{{ route('tasks.changeAssignee', $task) }}" method="post">
                                    @csrf
                                    <select name="assigned_to" required>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit">Change Assignee</button>
                                </form>
                                <form action="{{ route('tasks.start', $task) }}" method="post">
                                    @csrf
                                    <button type="submit">Start</button>
                                </form>
                            @elseif ($task->status === 'In Progress')
                                <form action="{{ route('tasks.done', $task) }}" method="post">
                                    @csrf
                                    <button type="submit">Done</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6"> No Result</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
