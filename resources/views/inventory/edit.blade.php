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
          <h3 class="box-title">{{trans('item.inventory_data_tracking')}}</h3><a class="btn btn-small btn-primary pull-right" href="{{ URL::to('items/create') }}"><i class="fa fa-plus"></i>&nbsp; {{trans('item.new_item')}}</a>
        </div>
      </div>
        <!-- /.box-header -->
        <div class="box">
          <div class="box-header"></div>
        	<div class="box-body">

					<table class="table table-bordered">
					<tr><td>{{__('UPC/EAN/ISBN')}}</td><td>{{ $item->upc_ean_isbn }}</td></tr>
					<tr><td>{{trans('item.item_name')}}</td><td>{{ $item->item_name }}</td></tr>
					<tr><td>{{trans('item.current_quantity')}}</td><td>{{ $item->quantity }}</td></tr>
					</table>
					<div class="row" style="padding: 20px 0;">
						{{ Form::model($item->inventory, ['route' => ['inventory.update', $item->id], 'method' => 'PUT']) }}
						<div class="col-sm-2 col-sm-offset-1">
						{{trans('item.inventory_to_add_subtract')}} *
						</div>
						<div class="col-sm-2">
						{{ Form::text('in_out_qty', null, ['class' => 'form-control', 'required']) }}
						</div>
						<div class="col-sm-1">
						{{trans('item.comments')}}
						</div>
						<div class="col-sm-4">
						{{ Form::text('remarks', null, ['class' => 'form-control', 'required']) }}
						</div>
						<div class="col-sm-1"> 
						{{ Form::submit(trans('item.submit'), ['class' => 'btn btn-primary']) }}
						
						</div>
						{{ Form::close() }}
					</div>
					<table class="table table-striped table-bordered">
					    <thead>
					        <tr>
					            <td>{{trans('item.inventory_data_tracking')}}</td>
					            <td>{{trans('item.employee')}}</td>
					            <td>{{trans('item.in_out_qty')}}</td>
					            <td>{{trans('item.remarks')}}</td>
					        </tr>
					    </thead>
					    <tbody>
					    @foreach($item->inventory as $value)
					        <tr>
					            <td>{{ $value->created_at }}</td>
					            <td>{{ $value->user->name }}</td>
					            <td>{{ $value->in_out_qty }}</td>
					            <td>{{ $value->remarks }}</td>
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