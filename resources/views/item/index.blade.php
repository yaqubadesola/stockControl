@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>{{trans('item.list_items')}}</h1>
  
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      
        <!-- /.box-header -->
      <!-- /.box -->
       @include('partials.flash')
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{__('Item List')}}</h3><a class="btn btn-small btn-primary pull-right" href="{{ URL::to('items/create') }}"><i class="fa fa-plus"></i>&nbsp; {{trans('item.new_item')}}</a>
        </div>
      </div>
        <!-- /.box-header -->
        <div class="box">
          <div class="box-header"></div>
        <div class="box-body">

<table class="table table-striped table-bordered table-responsive" id="myTable">
    <thead>
        <tr>
            <td>{{trans('item.item_id')}}</td>
            <td>{{trans('item.upc_ean_isbn')}}</td>
            <td>{{trans('item.item_name')}}</td>
            <td>{{trans('item.size')}}</td>
            <td>{{trans('item.cost_price')}}</td>
            <td>{{trans('item.selling_price')}}</td>
            <td>{{trans('item.quantity')}}</td>
            <td>&nbsp;</td>
            <td>{{trans('item.avatar')}}</td>
        </tr>
    </thead>
    <tbody>
    @foreach($item as $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->upc_ean_isbn }}</td>
            <td>{{ $value->item_name }}</td>
            <td>{{ $value->size }}</td>
            <td>{{ $value->cost_price }}</td>
            <td>{{ $value->selling_price }}</td>
            <td>{{ $value->quantity }}</td>
            <td class="item_btn_group">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-list"></i><span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('inventory/' . $value->id . '/edit') }}"><i class="fa fa-list"></i> {{trans('item.inventory')}}</a></li>
                    <li><a href="{{ url('items/' . $value->id . '/edit') }}"><i class="fa fa-pencil"></i> {{trans('item.edit')}}</a></li>
                    <li>
                        <a href="#" class="delete-form" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i>{{ Form::open(array('url' => 'items/' . $value->id, 'class' => 'form-inline')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit(trans('item.delete'), array('class' => 'delete-btn')) }}
                {{ Form::close() }}</a></li>
                  </ul>
                </div>
            </td>
            <td><img src="{{asset($value->avatar)}}" alt="" height="50"></td>
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

