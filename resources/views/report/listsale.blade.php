
<table class="table table-striped table-bordered list-of-sales" id="list-sale-report">
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
            </tr>
        @endforeach

        </tbody>
    @endif
</table>