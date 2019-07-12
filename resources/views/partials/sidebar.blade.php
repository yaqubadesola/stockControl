@if (Auth::check())
<aside class="main-sidebar">
	<section class="sidebar">
		<!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('dist/img/avatar.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          @if(auth()->user()->hasPermissionTo('customers.index'))
            <li class=""><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>{{trans('menu.dashboard')}}</span></a></li>
            <li class="{{(Request::is('customers')) ? 'active' : ''}} "><a href="{{ url('/customers') }}"><i class="fa fa-users"></i> <span>{{trans('menu.customers')}}</span></a></li>
          @endif
          @if(auth()->user()->hasPermissionTo('items.index'))
		    <li class="{{(Request::is('items')) ? 'active' : ''}} "><a href="{{ url('/items') }}"><i class="fa fa-bars"></i> <span>Stocks</span></a></li>
          @endif
		<!-- <li><a href="{{ url('/item-kits') }}">{{trans('menu.item_kits')}}</a></li> -->
          @if(auth()->user()->hasPermissionTo('suppliers.index'))
            <li class="{{(Request::is('suppliers')) ? 'active' : ''}} "><a href="{{ url('/suppliers') }}"><i class="fa fa-cubes"></i> <span>{{trans('menu.suppliers')}}</span></a></li>
          @endif
          @if(auth()->user()->hasPermissionTo('receivings.index'))
		    <li class="{{(Request::is('receivings')) ? 'active' : ''}} "><a href="{{ url('/receivings') }}"><i class="fa fa-sitemap"></i> <span>{{trans('menu.receivings')}}</span></a></li>
          @endif
          @if(auth()->user()->hasPermissionTo('sales.index'))
		    <li class="{{(Request::is('sales')) ? 'active' : ''}} "><a href="{{ url('/sales') }}">
                <i class="fa fa-shopping-cart"></i> <span>{{trans('menu.sales')}}</span></a>
            </li>
          @endif
          @if(auth()->user()->hasPermissionTo('accounts.index'))
      <li class="{{(Request::is('accounts')) ? 'active' : ''}} treeview">
          <a href="#"><i class="fa fa-university"></i> <span>{{trans('menu.accounts')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
              <li class="{{(Request::is('accounts')) ? 'active' : ''}} ">
                  <a href="{{ url('/accounts') }}"><i class="fa fa-circle-o"></i> <span>{{trans('menu.accounts')}}</span></a>
              </li>
              <li class="{{(Request::is('transactions')) ? 'active' : ''}}">
                  <a href="{{ url('transactions') }}"><i class="fa fa-circle-o"></i> Transactions</a>
              </li>
          </ul>
      </li>
          @endif
          @if(auth()->user()->hasPermissionTo('expense.index'))
    <li class="{{(Request::is('expense')) ? 'active' : ''}} treeview">
      <a href="#">
        <i class="fa fa-dollar"></i> <span>{{trans('menu.expense')}}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{(Request::is('expense')) ? 'active' : ''}}"><a href="{{ url('/expense') }}"><i class="fa fa-circle-o"></i> <span>{{trans('menu.expense')}}</span></a></li>
        <li class="{{(Request::is('expensecategory')) ? 'active' : ''}}"><a href="{{ url('expensecategory') }}"><i class="fa fa-circle-o"></i> Expense Category</a></li>
      </ul>
    </li>
    @endif
    @if(auth()->user()->hasPermissionTo('reports.getsales'))
    <li class="{{(Request::is('reports')) ? 'active' : ''}} treeview">
      <a href="#">
        <i class="fa fa-money"></i> <span>{{trans('menu.reports')}}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{(Request::is('reports/receivings')) ? 'active' : ''}}"><a href="{{ url('/reports/receivings') }}"><i class="fa fa-circle-o"></i> {{trans('menu.receivings_report')}}</a></li>
        <li class="{{(Request::is('reports/sales')) ? 'active' : ''}}"><a href="{{ url('/reports/sales') }}"><i class="fa fa-circle-o"></i> {{trans('menu.sales_report')}}</a></li>
        <li class="{{(Request::is('reports/getsale')) ? 'active' : ''}}"><a href="{{ url('/reports/getsale') }}"><i class="fa fa-circle-o"></i> {{trans('menu.print_sales_report')}}</a></li>
        <li class="{{(Request::is('reports/dailyreport/create')) ? 'active' : ''}}"><a href="{{ url('/reports/dailyreport/create') }}"><i class="fa fa-circle-o"></i> {{trans('menu.daily_report')}}</a></li>
      </ul>
    </li>
      @endif
      @if(auth()->user()->hasPermissionTo('employees.index'))
            <li class=""><a href="{{ url('/employees') }}"><i class="fa fa-user"></i> <span>{{trans('menu.employees')}}</span></a></li>
      @endif
    </ul>
</section>
</aside>
@endif