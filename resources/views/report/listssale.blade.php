
<table class="table table-striped table-bordered" id="list-sale-report">
    <thead>
    <tr>
        <td>{{trans('report-sale.sale_id')}}</td>
        <td>{{trans('report-sale.date')}}</td>
        <td>{{trans('report-sale.items_purchased')}}</td>
        <td>{{trans('report-sale.sold_by')}}</td>
        <td>{{trans('report-sale.sold_to')}}</td>
        <td>{{trans('report-sale.total')}}</td>
        <td>{{trans('report-sale.profit')}}</td>
        <td>{{trans('report-sale.payment_type')}}</td>
        <td>{{trans('report-sale.comments')}}</td>
        <td>&nbsp;</td>
    </tr>
    </thead>
    @if(count($saleReport))
        <tbody class="list-sale-report">

        @foreach($saleReport as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{DB::table('sale_items')->where('sale_id', $value->id)->sum('quantity')}}</td>
                <td>{{ $value->user->name }}</td>
                <td>{{ $value->customer->name }}</td>
                <td>${{$value->grand_total}}</td>
                <td>{{$value->grand_total - DB::table('sale_items')->where('sale_id', $value->id)->sum('total_cost')}}</td>
                <td>{{ $value->payment_type }}</td>
                <td>{{ $value->comments }}</td>
                <td>
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
    @endif
</table>