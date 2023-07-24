@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>


                    <div class="card responsive m-1 admin-wrapp">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('employees.index') }}">
                                        <div class="card m-1">
                                            <div class="card-header"><strong> Employee </strong></div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="embed-responsive embed-responsive-1by1 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="col-9"><span> Employee </span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <a href="{{ route('tasks.index') }}">
                                        <div class="card m-1">
                                            <div class="card-header"><strong> Task </strong></div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="embed-responsive embed-responsive-1by1 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="col-9"><span> Task </span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>





                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
