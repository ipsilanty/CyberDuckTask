@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employees
            <small>Edit {{$data['employee']->first_name}} {{$data['employee']->last_name}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/employees') }}"><i class="fa fa-users"></i> Employees</a></li>
            <li><a href="/employees/{{$data['employee']->id}}"><i class="fa fa-user"></i> {{$data['employee']->first_name}} {{$data['employee']->last_name}}</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
        <!-- /Content Header -->

        <!-- Main content -->
    <section class="content">
        <!-- include messages file -->
        @include('inc.messages')
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- form start -->
                    {!! Form::open(['action' => ['EmployeesController@update', $data['employee']->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="box-body">
                            <div class="form-group">
                                {{Form::label('first_name', 'First Name')}}
                                {{Form::text('first_name', $data['employee']->first_name, ['class' => 'form-control', 'placeholder' => 'First Name'])}}
                            </div>
                            <div class="form-group">
                                    {{Form::label('last_name', 'Last Name')}}
                                    {{Form::text('last_name', $data['employee']->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name'])}}
                                </div>
                            <div class="form-group">
                                    {{Form::label('email', 'Email Address')}}
                                    {{Form::email('email', $data['employee']->email, ['class' => 'form-control', 'placeholder' => 'Email Address'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('phone', 'Phone')}}
                                {{Form::text('phone', $data['employee']->phone, ['class' => 'form-control', 'placeholder' => 'i.e 07470229745'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('company', 'Company')}}
                                {{Form::select('company', $data['companies'], $data['employee']->companies->id, ['class' => 'form-control', 'placeholder' => 'Select company'])}}
                            </div>
                        </div>
                        <!-- /.box-body -->
                        {{Form::hidden('_method', 'PUT')}}
                        <div class="box-footer">
                            {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- /Main content -->
</div>
<!-- /Content Wrapper -->
@endsection