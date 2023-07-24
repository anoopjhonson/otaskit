@extends('layouts.app')

@section('content')
    <h2>Edit Employee</h2>

    <form action="{{ route('employees.update', $employee) }}" method="post">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $employee->name) }}" required>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" value="{{ old('email', $employee->email) }}" required>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="mobile_no">Mobile No.:</label>
        <input class="form-control" type="text" name="mobile_no" value="{{ old('mobile_no', $employee->mobile_no) }}"
            required>
        @error('mobile_no')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="department">Department:</label>
        <select name="department" required class="form-control">
            <option value="Sales" {{ old('department', $employee->department) === 'Sales' ? 'selected' : '' }}>Sales
            </option>
            <option value="Marketing" {{ old('department', $employee->department) === 'Marketing' ? 'selected' : '' }}>
                Marketing</option>
            <option value="IT" {{ old('department', $employee->department) === 'IT' ? 'selected' : '' }}>IT</option>
        </select>
        @error('department')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="status">Status:</label>
        <select name="status" required class="form-control">
            <option value="Active" {{ old('status', $employee->status) === 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ old('status', $employee->status) === 'Inactive' ? 'selected' : '' }}>Inactive
            </option>
        </select>
        @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button class="btn btn-primary" type="submit">Update Employee</button>
    </form>
@endsection
