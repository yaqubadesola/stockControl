@php
$avatar = '/dist/img/avatar5.png';
if (trim($customer->avatar) != 'no-foto.png') {
    $avatar = $customer->avatar;
}
@endphp
@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{__('Customer Profile')}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
    <li><a href="#">{{__('User')}}</a></li>
    <li class="active">{{__('profile')}}</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
@include('partials.flash')
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{asset($avatar)}}" alt="User profile picture">

          <h3 class="profile-username text-center">{{$customer->name}}</h3>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>{{__('Balance')}} </b> <a class="pull-right">{{$customer->prev_balance}}</a>
            </li>
            <li class="list-group-item hidden-print">
              <b>{{__('Total Sales')}} </b> <a class="pull-right">{{number_format($total_sales,2)}}</a>
            </li>
          </ul>
          <a class="btn btn-primary btn-block hidden-print" href="#" data-toggle="modal" data-target="#myModal"><b>{{__('Add Payment')}}</b></a>
            <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">{{__('Add Payment')}}</h4>
                </div>
                <div class="modal-body">
                  {{ Form::open(['route'=>'customerpayments.store']) }}
                    <div class="form-group">
                        {{ Form::select('payment_type', ['Cash' => 'Cash', 'Check' => 'Check', 'DebitCard' => 'Debit Card', 'CreditCard' => 'Credit Card'], null, array('class' => 'form-control','placeholder'=>'Select a payment type','required')) }}
                    </div>
                  <div class="form-group">
                    {{ Form::hidden('customer_id', $customer->id, ['class'=>'form-control']) }}
                    {{ Form::number('payment', null, ['class'=>'form-control', 'placeholder'=>'Amount', 'required']) }}
                  </div>
                    <div class="form-group">
                        {{ Form::text('comments', null, ['class'=>'form-control','placeholder'=>'Comments']) }}
                    </div>
                  <div class="form-group">
                    {{ Form::submit('Add Payment', ['class'=>'btn btn-primary']) }}
                  </div>
                  {{ Form::close() }}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
     <!-- About Me Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{__('Payment History')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>{{__('Date')}}</th>
                <th>{{__('Payment')}}</th>
                <th>{{__('Received')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($customer_payments as $customer_payment)
              <tr>
                <td>{{$customer_payment->created_at}}</td>
                <td>{{$customer_payment->payment}}</td>
                <?php $user= DB::table('users')->where('id', $customer_payment->user_id)->first(); ?>
                <td>{{$user->name}}</td>
              </tr>
              @endforeach
              <tr>
                <td colspan="3" style="background: #3c8dbc;padding: 2px;"></td>
              </tr>
              @foreach($sale_payments as $sale_payment)
              <tr>
                <td>{{$sale_payment->created_at}}</td>
                <td>{{$sale_payment->payment}}</td>
                <?php $user= DB::table('users')->where('id', $sale_payment->user_id)->first(); ?>
                <td>{{$user->name}}</td>
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
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#saledues" data-toggle="tab">{{__('Sales Open')}}</a></li>
          <li><a href="#salescompleted" data-toggle="tab">{{__('Sales Closed')}}</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="saledues">
            <!-- Post -->
            @if(count($saleReport_dues))
              <table class="table table-striped table-bordered table-hover" id="myTable1">
                  <thead>
                  <tr>
                      <th width="50" class="hidden-print">{{__('ID')}}</th>
                      <th>{{trans('report-sale.date')}}</th>
                      <th>{{trans('report-sale.items_purchased')}}</th>
                      <th>{{trans('report-sale.sold_by')}}</th>
                      
                      <th>{{trans('report-sale.total')}}</th>
                      <th>{{trans('report-sale.payment')}}</th>
                      <th>{{trans('report-sale.dues')}}</th>
                      <th>{{trans('report-sale.payment_type')}}</th>
                      <th>{{trans('report-sale.comments')}}</th>
                      <th width="60" class="hidden-print">&nbsp;</th>
                  </tr>
                  </thead>

                  <tbody class="list-sale-report">

                  @foreach($saleReport_dues as $value)
                      <tr>
                          <td class="hidden-print">{{ $value->id }}</td>
                          
                          <td>{{ $value->created_at }}</td>
                          <td>{{DB::table('sale_items')->where('sale_id', $value->id)->sum('quantity')}}</td>
                          <td>{{ $value->user->name }}</td>
                          
                          <td>${{$value->grand_total}}</td>
                          <td>${{$value->payment}} </td>
                          <td>${{$value->dues}}</td>
                          <td>{{ $value->payment_type }}</td>
                          <td>{{ $value->comments }}</td>
                          <td class="hidden-print">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                  <i class="fa fa-list"></i><span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a data-toggle="collapse" href="#detailedSales{{ $value->id }}" aria-expanded="false" aria-controls="detailedReceivings"><i class="fa fa-eye"></i> 
                                    {{trans('report-sale.detail')}}</a>
                                  </li>
                                  @if($value->dues > 0)
                                  <li><a href="#" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="fa fa-money"></i>  {{__('Payment')}}</a>
                                  
                                  @endif
                                  <li>
                                  <a href="{{url('sales/'. $value->id.'/edit')}}" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i> {{__('Close')}}
                                  </a>
                                  </li>
                                </ul>
                                <div class="modal fade" id="myModal{{$value->id}}" role="dialog">
                                  <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">{{__('Add Payment')}}</h4>
                                      </div>
                                      <div class="modal-body">
                                        {{ Form::open(['route'=>'salepayments.store']) }}
                                        <div class="form-group">
                                        {{ Form::select('payment_type', ['Cash' => 'Cash', 'Check' => 'Check', 'DebitCard' => 'Debit Card', 'CreditCard' => 'Credit Card'], null, array('class' => 'form-control','placeholder'=>'Select a payment type','required')) }}
                                        </div>
                                        <div class="form-group">
                                          {{ Form::hidden('sale_id', $value->id, ['class'=>'form-control']) }}
                                            {{ Form::number('payment', null, ['class'=>'form-control', 'placeholder'=>'Amount', 'required']) }}
                                        </div>
                                          <div class="form-group">
                                              {{ Form::text('comments', null, ['class'=>'form-control','placeholder'=>'Comments']) }}
                                          </div>
                                        <div class="form-group">
                                          {{ Form::submit('Add Payment', ['class'=>'btn btn-primary']) }}
                                        </div>
                                        {{ Form::close() }}
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </td>
                      </tr>

                      <tr class="collapse" id="detailedSales{{ $value->id }}">
                          <td colspan="10">
                              <table class="table">
                                  <tr>
                                      <td>{{trans('report-sale.item_id')}}</td>
                                      <td>{{trans('report-sale.item_name')}}</td>
                                      <td>{{trans('report-sale.quantity_purchase')}}</td>
                                      <td>{{trans('report-sale.total')}}</td>
                                      <td>{{trans('report-sale.profit')}}</td>
                                  </tr>
                                  @foreach(App\Sale::sale_detailed($value->id) as $SaleDetailed)
                                      <tr>
                                          <td>{{ $SaleDetailed->item_id }}</td>
                                          <td>{{ $SaleDetailed->item->item_name }}</td>
                                          <td>{{ $SaleDetailed->quantity }}</td>
                                          <td>{{ $SaleDetailed->selling_price * $SaleDetailed->quantity}}</td>
                                          <td>{{ ($SaleDetailed->quantity * $SaleDetailed->selling_price) - ($SaleDetailed->quantity * $SaleDetailed->cost_price)}}</td>
                                      </tr>
                                  @endforeach
                              </table>
                          </td>
                      </tr>

                  @endforeach

                  </tbody>
              </table>
              @endif
            <!-- /.post -->
            <div class="paginations hidden-print">
                {{ $saleReport_dues->render() }}
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="salescompleted">
            <!-- The timeline -->
            @if(count($saleReport_completed))
              <table class="table table-striped table-bordered" id="list-sale-report">
                  <thead>
                  <tr>
                      <td width="50">{{__('ID')}}</td>
                      <td>{{trans('report-sale.date')}}</td>
                      <td>{{trans('report-sale.items_purchased')}}</td>
                      <td>{{trans('report-sale.sold_by')}}</td>
                      
                      <td>{{trans('report-sale.total')}}</td>
                      <td>{{trans('report-sale.payment')}}</td>
                      <td>{{trans('report-sale.dues')}}</td>
                      <td>{{trans('report-sale.payment_type')}}</td>
                      <td>{{trans('report-sale.comments')}}</td>
                      <td width="60" class="hidden-print">&nbsp;</td>
                  </tr>
                  </thead>

                  <tbody class="list-sale-report">

                  @foreach($saleReport_completed as $value)
                      <tr>
                          <td>{{ $value->id }}</td>
                          
                          <td>{{ $value->created_at }}</td>
                          <td>{{DB::table('sale_items')->where('sale_id', $value->id)->sum('quantity')}}</td>
                          <td>{{ $value->user->name }}</td>
                          
                          <td>${{$value->grand_total}}</td>
                          
                          <td>${{$value->payment}} </td>
                          <td>${{$value->dues}}</td>
                          
                          <td>{{ $value->payment_type }}</td>
                          <td>{{ $value->comments }}</td>
                          <td class="hidden-print">
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-list"></i><span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a data-toggle="collapse" href="#detailedSales{{ $value->id }}" aria-expanded="false" aria-controls="detailedReceivings"><i class="fa fa-eye"></i> 
                                  {{trans('report-sale.detail')}}</a>
                                </li>
                                @if($value->dues > 0)
                                <li><a href="#" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="fa fa-money"></i>  {{__('Payment')}}</a>
                                
                                @endif
                                <li>
                                <a href="{{url('sales/'. $value->id.'/')}}" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i> {{__('Open')}}
                                </a>
                                </li>
                              </ul>
                              <div class="modal fade" id="myModal{{$value->id}}" role="dialog">
                                <div class="modal-dialog modal-sm">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">{{__('Add Payment')}}</h4>
                                    </div>
                                    <div class="modal-body">
                                      {{ Form::open(['route'=>'salepayments.store']) }}
                                      <div class="form-group">
                                        {{ Form::select('payment_type', ['Cash' => 'Cash', 'Check' => 'Check', 'DebitCard' => 'Debit Card', 'CreditCard' => 'Credit Card'], null, array('class' => 'form-control','placeholder'=>'Select a payment type','required')) }}
                                      </div>
                                      <div class="form-group">
                                        {{ Form::hidden('sale_id', $value->id, ['class'=>'form-control']) }}
                                          {{ Form::number('payment', null, ['class'=>'form-control', 'placeholder'=>'Amount', 'required']) }}
                                      </div>
                                        <div class="form-group">
                                            {{ Form::text('comments', null, ['class'=>'form-control','placeholder'=>'Comments']) }}
                                        </div>
                                      <div class="form-group">
                                        {{ Form::submit('Add Payment', ['class'=>'btn btn-primary']) }}
                                      </div>
                                      {{ Form::close() }}
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                          </td>
                      </tr>

                      <tr class="collapse" id="detailedSales{{ $value->id }}">
                          <td colspan="10">
                              <table class="table">
                                  <tr>
                                      <td>{{trans('report-sale.item_id')}}</td>
                                      <td>{{trans('report-sale.item_name')}}</td>
                                      <td>{{trans('report-sale.quantity_purchase')}}</td>
                                      <td>{{trans('report-sale.total')}}</td>
                                      <td>{{trans('report-sale.profit')}}</td>
                                  </tr>
                                  @foreach(App\Sale::sale_detailed($value->id) as $SaleDetailed)
                                      <tr>
                                          <td>{{ $SaleDetailed->item_id }}</td>
                                          <td>{{ $SaleDetailed->item->item_name }}</td>
                                          <td>{{ $SaleDetailed->quantity }}</td>
                                          <td>{{ $SaleDetailed->selling_price * $SaleDetailed->quantity}}</td>
                                          <td>{{ ($SaleDetailed->quantity * $SaleDetailed->selling_price) - ($SaleDetailed->quantity * $SaleDetailed->cost_price)}}</td>
                                      </tr>
                                  @endforeach
                              </table>
                          </td>
                      </tr>

                  @endforeach

                  </tbody>
              </table>
              @endif
              <div class="paginations hidden-print">
                {{ $saleReport_completed->render() }}
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
@endsection
