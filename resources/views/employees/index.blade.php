@extends('layouts.app')

@section('content')
    <h2>Employees</h2>
    <a href="{{ route('employees.create') }}">Add Employee</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile No.</th>
                <th>Department</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->mobile_no }}</td>
                    <td>{{ $employee->department }}</td>
                    <td>{{ $employee->status }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure delete employee?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
