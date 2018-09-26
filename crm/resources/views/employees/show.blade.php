@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employee Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/employees') }}"><i class="fa fa-users"></i> Employees</a></li>
            <li class="active">{{$employee->first_name}} {{$employee->last_name}}</li>
        </ol>
    </section>
    <!-- /Content Header -->

    <!-- Main content -->
    <section class="content">
        <!-- include messages file -->
        @include('inc.messages')
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-yellow">
                        <h3 class="widget-user-username">{{$employee->first_name}} {{$employee->last_name}}</h3>
                        <a href="/companies/{{$employee->companies->id}}" class="widget-user-desc company" title="{{$employee->companies->name}}">{{$employee->companies->name}}</a>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="mailto:{{$employee->email}}">Email <span class="pull-right">{{$employee->email}}</span></a></li>
                            <li><a href="tel:{{$employee->phone}}">Phone <span class="pull-right">{{$employee->phone}}</span></a></li>
                        </ul>
                        <div class="actions">
                            <div class="col-xs-6">
                                <a href="/employees/{{$employee->id}}/edit" class="btn btn-default btn-block"><b>Edit Employee</b></a>
                            </div>
                            <div class="col-xs-6">
                                <!-- Action to delete company -->
                                {!! Form::open(['action' => ['EmployeesController@destroy', $employee->id], 'method' => 'POST', 'class' => 'delete_employee']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete Employee', ['class' => 'btn btn-danger btn-block'])}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- /Main content -->
</div>
<!-- /Content Wrapper -->
@endsection