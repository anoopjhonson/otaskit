@extends('layouts.app')

@section('content')
    <h2>Add Employee</h2>

    <form action="{{ route('employees.store') }}" method="post">
        @csrf
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="mobile_no">Mobile No.:</label>
        <input type="text" class="form-control" name="mobile_no" value="{{ old('mobile_no') }}" required>
        @error('mobile_no')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="department">Department:</label>
        <select class="form-control" name="department" required>
            <option value="Sales">Sales</option>
            <option value="Marketing">Marketing</option>
            <option value="IT">IT</option>
        </select>
        @error('department')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="status">Status:</label>
        <select class="form-control" name="status" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
@endsection
