@extends('layouts.sale')

@section('content')
<div class="content-wrapper" id="app">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Sales/Invoices')}}</h1>
      
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('partials.flash')
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('report-sale.reports')}} - {{trans('report-sale.sales_report')}}</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="well well-sm">{{trans('report-sale.grand_total')}}: {{DB::table('sales')->sum('grand_total')}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="well well-sm">{{trans('report-sale.payment')}}: {{DB::table('sales')->sum('payment')}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="well well-sm">{{trans('report-sale.dues')}}: {{DB::table('sales')->sum('dues')}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label >{{__('From')}}</label>
                                <input type="text" name="StartDate" id="lStartDate" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="EndDate">{{__('To')}}</label>
                                <input type="text" name="EndDate" id="lEndDate" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    @if(count($saleReport))
                    <table class="table table-striped table-bordered" id="list-sale-report">
                        <thead>
                        <tr>
                            <td width="50">{{__('ID')}}</td>
                            <td>{{trans('report-sale.date')}}</td>
                            <td>{{trans('report-sale.items_purchased')}}</td>
                            <td>{{trans('report-sale.sold_by')}}</td>
                            <td>{{trans('report-sale.sold_to')}}</td>
                            <td>{{trans('report-sale.total')}}</td>
                            <td>{{trans('report-sale.payment')}}</td>
                            <td>{{trans('report-sale.dues')}}</td>
                            <td>{{trans('report-sale.payment_type')}}</td>
                            <td>{{trans('report-sale.comments')}}</td>
                            <td>&nbsp;</td>
                        </tr>
                        </thead>

                        <tbody class="list-sale-report">

                        @foreach($saleReport as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                
                                <td>{{ $value->created_at }}</td>
                                <td>{{DB::table('sale_items')->where('sale_id', $value->id)->sum('quantity')}}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->customer->name }}</td>
                                <td>${{$value->grand_total}}</td>
                               
                                <td>${{$value->payment}}</td>
                                <td>${{$value->dues}}</td>
                               
                                
                                <td>{{ $value->payment_type }}</td>
                                <td>{{ $value->comments }}</td>
                                <td>
                                    @if($value->dues > 0)
                                    <a class="btn btn-small btn-info" href="#" data-toggle="modal" data-target="#myModal{{$value->id}}">Add Payment</a>
                                    
                                    <div class="modal fade" id="myModal{{$value->id}}" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Add Payment</h4>
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
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                    @endif
                                    <a class="btn btn-small btn-info" data-toggle="collapse" href="#detailedSales{{ $value->id }}" aria-expanded="false" aria-controls="detailedReceivings">
                                        {{trans('report-sale.detail')}}</a>
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
                    <div class="paginations col-md-12 hidden-print">
                        {{ $saleReport->render() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        $("#StartDate").datepicker({
            changeDate:true,
            changeMonth:true,
            changeYear:true,
            yearRange:'1970:+0',
            dateFormat:'yy-mm-dd',
            onSelect:function(dateText){
                var DateCreated = $('#StartDate').val();
                var EndDate = $('#EndDate').val();

                listSales(DateCreated,EndDate);
            }
        });
        $("#EndDate").datepicker({
            changeDate:true,
            changeMonth:true,
            changeYear:true,
            yearRange:'1970:+0',
            dateFormat:'yy-mm-dd',
            onSelect:function(dateText){
                var DateCreated = $('#StartDate').val();
                var EndDate = $('#EndDate').val();
                listSales(DateCreated, EndDate);
            }
        });
        function listSales(criteria1, criteria2)
        {
            $.ajax({
                type : 'get',
                url : "{{ url('reports/getsales') }}",
                data : {DateCreated:criteria1,EndDate:criteria2},
                success:function(data)
                {
                    $('#list-sale-report').empty().html(data);
                }
            })
        }


    </script>
    @endsection