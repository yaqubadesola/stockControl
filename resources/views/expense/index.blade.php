@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Expenses')}}</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Expense')}}</a></li>
        <li class="active">{{__('All')}}</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
          <!-- /.box -->
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{__('Expense List')}}</h3><a class="btn btn-small btn-primary pull-right" href="{{ URL::to('expense/create') }}"><i class="fa fa-plus"></i>&nbsp; {{__('Create Expense')}}</a>
            </div>
          </div>
            <!-- /.box-header -->
            <div class="box">
              <div class="box-header"></div>
            <div class="box-body">
              <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="140">{{__('Created at')}}</th>
                        <th width="30">{{__('Qty')}}</th>
                        <th>{{__('Unit Price')}}</th>
                        <th>{{__('Total')}}</th>
                        <th>{{__('Payment')}}</th>
                        <th>{{__('Dues')}}</th>
                        <th>{{__('Category')}}</th>
                        <th width="50">{{__('Type')}}</th>
                        <th>{{__('Created By')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
    	@foreach($expenses as $value)
        <tr>
          <td>{{ $value->created_at }}</td>
          <td>{{ $value->qty }}</td>
          <td>{{ $value->unit_price }}</td>
          <td>{{ $value->total }}</td>
          <td>{{$value->payment}}</td>
          <td>{{$value->dues}}</td>
          <td>{{$value->expense_category->name}}</td>
          <td>{{$value->payment_type}}</td>
          <td>{{$value->user->name}}</td>
          <td class="item_btn_group">
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-list"></i><span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ url('expense/' . $value->id . '/edit') }}"><i class="fa fa-pencil"></i> {{trans('expense.edit')}}</a></li>
                  <li>
                      <a href="#" class="delete-form" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i>{{ Form::open(array('url' => 'expense/' . $value->id, 'class' => 'form-inline')) }}
                  {{ Form::hidden('_method', 'DELETE') }}
                  {{ Form::submit(trans('expense.delete'), array('class' => 'delete-btn')) }}
                  {{ Form::close() }}</a></li>
                </ul>
              </div>
          </td>
        </tr>
      @endforeach
    </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection
