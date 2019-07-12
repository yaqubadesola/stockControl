@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Expense Category')}}</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Expense Category')}}</a></li>
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
              <h3 class="box-title">{{__('Expense Category List')}}</h3><a class="btn btn-small btn-primary pull-right" href="#modal-id" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Create Expense Category')}}</a>
              
              <div class="modal fade" id="modal-id">
                  <div class="modal-dialog">
                      {{ Form::open(['route' => 'expensecategory.store', 'method' => 'post']) }}
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">{{__('Add A Expense Category')}}</h4>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                  {{ Form::label('name', __('Name *')) }}
                                  {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
                              </div>
                              <div class="form-group">
                                  {{ Form::label('description', __('Description')) }}
                                  {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                              <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                          </div>
                      </div>
                      {{ Form::close() }}
                  </div>
              </div>

            </div>
          </div>
            <!-- /.box-header -->
            <div class="box">
              <div class="box-header">
                  <div class="button-group">
                    @foreach($expense_categories as $value)
                    <button type="button" class="btn btn-info"><a href="{{route('expensecategory.show', $value->id)}}" style="color:#fff;">{{$value->name}}</a></button>
                    @endforeach
                  </div>
              </div>
            <div class="box-body">
              @if(!empty($expensecategory))
              <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th width="70">{{__('Created at')}}</th>
                      <th>{{__('Qty')}}</th>
                      <th>{{__('Unit Price')}}</th>
                      <th>{{__('Total')}}</th>
                      <th>{{__('Payment')}}</th>
                      <th>{{__('Dues')}}</th>
                      <th>{{__('Category')}}</th>
                      <th>{{__('Type')}}</th>
                      <th>{{__('Created By')}}</th>
                      <th>{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expensecategory->expense as $expense)
                    <tr>
                      <td>{{ $expense->created_at }}</td>
                      <td>{{ $expense->qty }}</td>
                      <td>{{ $expense->unit_price }}</td>
                      <td>{{ $expense->total }}</td>
                      <td>{{$expense->payment}}</td>
                      <td>{{$expense->dues}}</td>
                      <td>{{$expense->expense_category->name}}</td>
                      <td>{{$expense->payment_type}}</td>
                      <td>{{$expense->user->name}}</td>
                      <td class="item_btn_group">
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-list"></i><span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('expense/' . $expense->id . '/edit') }}"><i class="fa fa-pencil"></i> {{trans('expense.edit')}}</a></li>
                              <li>
                                  <a href="#" class="delete-form" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i>{{ Form::open(array('url' => 'expense/' . $expense->id, 'class' => 'form-inline')) }}
                              {{ Form::hidden('_method', 'DELETE') }}
                              {{ Form::submit(trans('expense.delete'), array('class' => 'delete-btn')) }}
                              {{ Form::close() }}</a></li>
                            </ul>
                          </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="10">{{__('No Data Found')}}</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
              @endif
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
@section('script')
<script>
    $(function(){
        $('#myTable').DataTable({
    });
        });
</script>
@endsection