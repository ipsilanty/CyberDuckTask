@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Companies
            <small>Edit {{$company->name}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/companies') }}"><i class="fa fa-building"></i> Companies</a></li>
            <li><a href="/companies/{{$company->id}}"><img class="img-responsive img-circle" src="/storage/logo/{{$company->logo}}" alt="Company logo"></i> {{$company->name}}</a></li>
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
                    {!! Form::open(['action' => ['CompaniesController@update', $company->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="box-body">
                            <div class="form-group">
                                {{Form::label('name', 'Company')}}
                                {{Form::text('name', $company->name, ['class' => 'form-control', 'placeholder' => 'Company'])}}
                            </div>
                            <div class="form-group">
                                    {{Form::label('email', 'Email Address')}}
                                    {{Form::email('email', $company->email, ['class' => 'form-control', 'placeholder' => 'Email Address'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('website', 'Website')}}
                                {{Form::url('website', $company->website, ['class' => 'form-control', 'placeholder' => 'Website'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('logo', 'Company Logo')}}<small>(Min size: 100x100)</small>
                                {{Form::file('logo')}}
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