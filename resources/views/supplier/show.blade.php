@php
    $avatar = '/dist/img/avatar5.png';
    if (trim($supplier->avatar) != 'no-foto.png') {
        $avatar = $supplier->avatar;
    }
@endphp
@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{__('Supplier Profile')}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
    <li><a href="#">{{__('Supplier')}}</a></li>
    <li class="active"> {{__('profile')}}</li>
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

          <h3 class="profile-username text-center">{{$supplier->name}}</h3>

          <p class="text-muted text-center"> {{__('supplier Info')}}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Balance </b> <a class="pull-right">{{$supplier->prev_balance}}</a>
            </li>
            <li class="list-group-item">
              <b>Total Receivings </b> <a class="pull-right">{{number_format($total_receivings,2)}}</a>
            </li>
          </ul>
          <a class="btn btn-primary btn-block" href="#" data-toggle="modal" data-target="#myModal"><b>{{__('Add Payment')}}</b></a>
            <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">{{__('Add Payment')}}</h4>
                </div>
                <div class="modal-body">
                  {{ Form::open(['route'=>'supplierpayments.store']) }}
                  <div class="form-group">
                    {{ Form::select('payment_type', ['Cash' => 'Cash', 'Check' => 'Check', 'DebitCard' => 'Debit Card', 'CreditCard' => 'Credit Card'], null, array('class' => 'form-control','placeholder'=>'Select a payment type','required')) }}
                  </div>
                  <div class="form-group">
                    {{ Form::hidden('supplier_id', $supplier->id, ['class'=>'form-control','required']) }}
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
              @foreach($supplier_payments as $supplier_payment)
              <tr>
                <td>{{$supplier_payment->created_at}}</td>
                <td>{{$supplier_payment->payment}}</td>
                <?php $user= DB::table('users')->where('id', $supplier_payment->user_id)->first(); ?>
                <td>{{$user->name}}</td>
              </tr>
              @endforeach
              <tr>
                <td colspan="3" style="background: #3c8dbc;padding: 2px;"></td>
              </tr>
              @foreach($receiving_payments as $receiving_payment)
              <tr>
                <td>{{$receiving_payment->created_at}}</td>
                <td>{{$receiving_payment->payment}}</td>
                <?php $user= DB::table('users')->where('id', $receiving_payment->user_id)->first(); ?>
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
          <li class="active"><a href="#saledues" data-toggle="tab">{{__('Receivings Dues')}}</a></li>
          <li><a href="#salescompleted" data-toggle="tab">{{__('Receivings Completed')}}</a></li>
          <!-- <li><a href="#settings" data-toggle="tab">Receivings</a></li> -->
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="saledues">
            <!-- Post -->
            @if(count($receivingReport_dues))
              <table class="table table-striped table-bordered table-hover" id="myTable1">
                  <thead>
                  <tr>
                    <td width="20">{{__('ID')}}</td>
                    <td>{{trans('report-receiving.date')}}</td>
                    <td>{{trans('report-receiving.items_received')}}</td>
                    <td>{{trans('report-receiving.received_by')}}</td>
                    <td>{{trans('report-receiving.supplied_by')}}</td>
                    <td>{{trans('report-receiving.total')}}</td>
                    <td>{{trans('report-receiving.payment_type')}}</td>
                    <td>{{trans('report-receiving.payment')}}</td>
                    <td>{{trans('report-receiving.dues')}}</td>
                    <td>{{trans('report-receiving.comments')}}</td>
                    <td width="50" class="hidden-print">&nbsp;</td>
                  </tr>
                  </thead>

                  <tbody class="list-sale-report">

                  @foreach($receivingReport_dues as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>{{DB::table('receiving_items')->where('receiving_id', $value->id)->sum('quantity')}}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->supplier->company_name }}</td>
                        <td>{{DB::table('receiving_items')->where('receiving_id', $value->id)->sum('total_cost')}}</td>
                        <td>{{ $value->payment_type }}</td>
                        <td>{{ $value->payment }}</td>
                        <td>{{ $value->dues }}</td>
                          <td>{{ $value->comments }}</td>
                          <td class="hidden-print">
                              <div class="btn-group">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-list"></i><span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu">
                                      <li><a data-toggle="collapse" href="#detailedReports{{ $value->id }}" aria-expanded="false" aria-controls="detailedReceivings">
                                          <i class="fa fa-list"></i>  {{trans('report-sale.detail')}}</a>
                                    </li>
                                    @if($value->dues > 0)
                                    <li><a href="#" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="fa fa-money"></i>  {{__('Payment')}}</a>
                                    @endif
                                    <li>
                                    <a href="{{url('receivings/'. $value->id.'/edit')}}" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i> {{__('Close')}}
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
                                            {{ Form::open(['route'=>'receivingpayments.store']) }}
                                            <div class="form-group">
                                              {{ Form::select('payment_type', ['Cash' => 'Cash', 'Check' => 'Check', 'DebitCard' => 'Debit Card', 'CreditCard' => 'Credit Card'], null, array('class' => 'form-control','placeholder'=>'Select a payment type','required')) }}
                                            </div>
                                            <div class="form-group">
                                              {{ Form::hidden('receiving_id', $value->id, ['class'=>'form-control']) }}
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
                      <tr class="collapse" id="detailedReports{{ $value->id }}">
                        <td colspan="9">
                            <table class="table">
                                <tr>
                                    <td>{{trans('report-receiving.item_id')}}</td>
                                    <td>{{trans('report-receiving.item_name')}}</td>
                                    <td>{{trans('report-receiving.item_received')}}</td>
                                    <td>{{trans('report-receiving.total')}}</td>
                                </tr>
                                @foreach(App\Receiving::receiving_detailed($value->id) as $receiving_detailed)
                                    <tr>
                                        <td>{{ $receiving_detailed->item_id }}</td>
                                        <td>{{ $receiving_detailed->item->item_name }}</td>
                                        <td>{{ $receiving_detailed->quantity }}</td>
                                        <td>{{ $receiving_detailed->quantity * $receiving_detailed->cost_price}}</td>
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
                {{ $receivingReport_dues->render() }}
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="salescompleted">
            <!-- The timeline -->
            @if(count($receivingReport_completed))
            <table class="table table-striped table-bordered table-hover" id="myTable1">
              <thead>
              <tr>
                <td width="50">{{__('ID')}}</td>
                <td>{{trans('report-receiving.date')}}</td>
                <td>{{trans('report-receiving.items_received')}}</td>
                <td>{{trans('report-receiving.received_by')}}</td>
                <td>{{trans('report-receiving.supplied_by')}}</td>
                <td>{{trans('report-receiving.total')}}</td>
                <td>{{trans('report-receiving.payment_type')}}</td>
                <td>{{trans('report-receiving.payment')}}</td>
                <td>{{trans('report-receiving.dues')}}</td>
                <td>{{trans('report-receiving.comments')}}</td>
                <td>&nbsp;</td>
              </tr>
              </thead>

              <tbody class="list-sale-report">

              @foreach($receivingReport_completed as $value)
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>{{DB::table('receiving_items')->where('receiving_id', $value->id)->sum('quantity')}}</td>
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->supplier->company_name }}</td>
                    <td>{{DB::table('receiving_items')->where('receiving_id', $value->id)->sum('total_cost')}}</td>
                    <td>{{ $value->payment_type }}</td>
                    <td>{{ $value->payment }}</td>
                    <td>{{ $value->dues }}</td>
                      <td>{{ $value->comments }}</td>
                      <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-list"></i><span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a data-toggle="collapse" href="#detailedReports{{ $value->id }}" aria-expanded="false" aria-controls="detailedReceivings">
                                    <i class="fa fa-list"></i>  {{trans('report-sale.detail')}}</a>
                              </li>
                              @if($value->dues > 0)
                              <li><a href="#" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="fa fa-money"></i> {{__('Payment')}}</a>
                              @endif
                              <li>
                              <a href="{{url('receivings/'. $value->id)}}" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i> {{__('Open')}}
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
                                      {{ Form::open(['route'=>'receivingpayments.store']) }}
                                      <div class="form-group">
                                        {{ Form::select('payment_type', ['Cash' => 'Cash', 'Check' => 'Check', 'DebitCard' => 'Debit Card', 'CreditCard' => 'Credit Card'], null, array('class' => 'form-control','placeholder'=>'Select a payment type','required')) }}
                                      </div>
                                      <div class="form-group">
                                        {{ Form::hidden('receiving_id', $value->id, ['class'=>'form-control']) }}
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

                  <tr class="collapse" id="detailedReports{{ $value->id }}">
                    <td colspan="9">
                        <table class="table">
                            <tr>
                                <td>{{trans('report-receiving.item_id')}}</td>
                                <td>{{trans('report-receiving.item_name')}}</td>
                                <td>{{trans('report-receiving.item_received')}}</td>
                                <td>{{trans('report-receiving.total')}}</td>
                            </tr>
                            @foreach(App\Receiving::receiving_detailed($value->id) as $receiving_detailed)
                                <tr>
                                    <td>{{ $receiving_detailed->item_id }}</td>
                                    <td>{{ $receiving_detailed->item->item_name }}</td>
                                    <td>{{ $receiving_detailed->quantity }}</td>
                                    <td>{{ $receiving_detailed->quantity * $receiving_detailed->cost_price}}</td>
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
                {{ $receivingReport_completed->render() }}
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
