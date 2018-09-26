<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            @if (Auth::check())
                <div class="pull-left image">
                    <i class="fa fa-user usr-img" aria-hidden="true"></i>
                </div>
                <div class="pull-left info">   
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            @endif
        </div>
        <!-- /Sidebar user panel -->

        <!-- sidebar menu: style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li id="default">
                <a href="{{ url('/') }}" data-url="">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <!-- Companies -->
            <li>
                <a href="{{ url('/companies') }}" data-url="companies">
                    <i class="fa fa-building"></i> <span>Companies</span>
                </a>
            </li>
            <!-- /Companies -->

            <!-- Employees -->
            <li>
                <a href="{{ url('/employees') }}" data-url="employees">
                    <i class="fa fa-users"></i> <span>Employees</span>
                </a>
            </li>
            <!-- /Employees -->
        </ul>
        <!-- /sidebar menu -->
    </section>
    <!-- /sidebar -->
</aside>