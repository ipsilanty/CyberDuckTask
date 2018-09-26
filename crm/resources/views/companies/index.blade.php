@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Companies
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Companies</li>
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
                            <a href="{{ url('/companies/create') }}" class="btn btn-block btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Company</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table id="companies" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Employees</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($companies) > 0)
                                    @foreach($companies as $company)
                                        <tr>
                                            <td><a href="/companies/{{$company->id}}" title="{{$company->name}}">{{$company->name}}</td>
                                            <td>
                                                <a href="mailto:{{$company->email}}"  title="{{$company->email}}">
                                                    @if(strlen($company->email) > 30)
                                                        {!! substr($company->email, 0, 30).'...' !!}
                                                    @else
                                                        {{$company->email}}
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{$company->website}}" target="_blank"  title="{{$company->website}}">
                                                    @if(strlen($company->website) > 30)
                                                        {!! substr($company->website, 0, 30).'...' !!}
                                                    @else
                                                        {{$company->website}}
                                                    @endif
                                                </a>
                                            </td>
                                            <td>{{count($company->employees)}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <!-- Action to delete company -->
                                                    {!! Form::open(['action' => ['CompaniesController@destroy', $company->id], 'method' => 'POST', 'class' => 'delete_company']) !!}
                                                        {{Form::hidden('_method', 'DELETE')}}
                                                        <a href="/companies/{{$company->id}}" title="View Company" class="btn btn-success btn-xs btn-action"><i class="fa fa-search" aria-hidden="true"></i> View</a>
                                                        <a href="/companies/{{$company->id}}/edit" title="Edit Company" class="btn btn-info btn-xs btn-action"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                                        <button type="submit" title="Delete Company" class="btn btn-danger btn-xs btn-action"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
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
                    @if(count($companies) > 0)
                        <div class="box-footer clearfix">
                            {{$companies->links()}}
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