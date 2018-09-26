@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Company Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/companies') }}"><i class="fa fa-building"></i> Companies</a></li>
            <li class="active">{{$company->name}}</li>
        </ol>
    </section>
    <!-- /Content Header -->

    <!-- Main content -->
    <section class="content">
        <!-- include messages file -->
        @include('inc.messages')
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                 <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="/storage/logo/{{$company->logo}}" alt="Company logo">
                        <h3 class="profile-username text-center">{{$company->name}}</h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email</b> <a href="mailto:{{$company->email}}" title="{{$company->email}}" class="pull-right cc_det">{{$company->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Website</b> <a href="{{$company->website}}" target="_blank" title="{{$company->website}}" class="pull-right cc_det">{{$company->website}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Employees</b> <a class="pull-right cc_det">{{count($company->employees)}}</a>
                            </li>
                        </ul>
                        <div class="col-xs-6">
                            <a href="/companies/{{$company->id}}/edit" class="btn btn-default btn-block"><b>Edit Company</b></a>
                        </div>
                        <div class="col-xs-6">
                            <!-- Action to delete company -->
                            {!! Form::open(['action' => ['CompaniesController@destroy', $company->id], 'method' => 'POST', 'class' => 'delete_company']) !!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete Company', ['class' => 'btn btn-danger btn-block'])}}
                            {!! Form::close() !!}
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