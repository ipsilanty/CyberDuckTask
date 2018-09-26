@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employees
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Employees</li>
        </ol>
    </section>
        <!-- /Content Header -->

        <!-- Main content -->
    <section class="content">
        <!-- include messages file -->
        @include('inc.messages')
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="pull-right">
                            <a href="{{ url('/employees/create') }}" class="btn btn-block btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Employee</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table id="employees" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($employees) > 0)
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td><a href="/employees/{{$employee->id}}" title="{{$employee->first_name}} {{$employee->last_name}}">{{$employee->first_name}} {{$employee->last_name}}</a></td>
                                            <td><a href="/companies/{{$employee->companies->id}}" title="{{$employee->companies->name}}">{{$employee->companies->name}}</a></td>
                                            <td><a href="mailto:{{$employee->email}}">{{$employee->email}}</a></td>
                                            <td><a href="tel:{{$employee->phone}}">{{$employee->phone}}</a></td>
                                            <td>
                                                <div class="btn-group">
                                                    <!-- Action to delete employee -->
                                                    {!! Form::open(['action' => ['EmployeesController@destroy', $employee->id], 'method' => 'POST', 'class' => 'delete_employee']) !!}
                                                        {{Form::hidden('_method', 'DELETE')}}
                                                        <a href="/employees/{{$employee->id}}" title="View Employee" class="btn btn-success btn-xs btn-action"><i class="fa fa-search" aria-hidden="true"></i> View</a>
                                                        <a href="/employees/{{$employee->id}}/edit" title="Edit Employee" class="btn btn-info btn-xs btn-action"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                                        <button type="submit" title="Delete Employee" class="btn btn-danger btn-xs btn-action"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    
                    <!-- Paggination -->
                    @if(count($employees) > 0)
                        <div class="box-footer clearfix">
                            {{$employees->links()}}
                        </div>
                    @endif
                    <!-- /Paggination -->
                </div>
            </div>
        </div>
    </section>
    <!-- /Main content -->
</div>
<!-- /Content Wrapper -->
@endsection