@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employees
            <small>Add new employee</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/employees') }}"><i class="fa fa-users"></i> Employees</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
        <!-- /Content Header -->

        <!-- Main content -->
    <section class="content">
        <!-- include messages file -->
        @include('inc.messages')
        <!-- /include messages file -->

        <!-- check for companies -->
        @if(count($select) == 0)
            <!-- display a warning message if there no companies -->
            <div class="alert alert-warning">
                <h4><i class="icon fa fa-warning"></i> Warning!</h4>
                No company recorded! Please <a href="{{url('companies/create')}}">create</a> a company before add an employee.
            </div>
        @else
            <!-- else display form to an a new employee -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <!-- form start -->
                        {!! Form::open(['action' => 'EmployeesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="box-body">
                                <div class="form-group">
                                    {{Form::label('first_name', 'First Name')}}
                                    {{Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'First Name'])}}
                                </div>
                                <div class="form-group">
                                        {{Form::label('last_name', 'Last Name')}}
                                        {{Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => 'Last Name'])}}
                                    </div>
                                <div class="form-group">
                                        {{Form::label('email', 'Email Address')}}
                                        {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email Address'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('phone', 'Phone')}}
                                    {{Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'i.e 07470229745'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('company', 'Company')}}
                                    {{Form::select('company', $select, '', ['class' => 'form-control', 'placeholder' => 'Select company'])}}
                                </div>
                            </div>
                            <!-- /.box-body -->
                            
                            <div class="box-footer">
                                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endif
    </section>
    <!-- /Main content -->
</div>
<!-- /Content Wrapper -->
@endsection