@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Companies
            <small>Add new company</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/companies') }}"><i class="fa fa-building"></i> Companies</a></li>
            <li class="active">Create</li>
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
                    {!! Form::open(['action' => 'CompaniesController@store', 'method' => 'POST', 'class' => 'create-company', 'enctype' => 'multipart/form-data']) !!}
                        <div class="box-body">
                            <div class="form-group">
                                {{Form::label('name', 'Company')}}
                                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Company'])}}
                            </div>
                            <div class="form-group">
                                    {{Form::label('email', 'Email Address')}}
                                    {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email Address'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('website', 'Website')}}
                                {{Form::url('website', '', ['class' => 'form-control', 'placeholder' => 'Website'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('logo', 'Company Logo')}}<small>(Min size: 100x100)</small>
                                {{Form::file('logo')}}
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
    </section>
    <!-- /Main content -->
</div>
<!-- /Content Wrapper -->
@endsection