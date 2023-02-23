<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">

    <li class="treeview {{ active_menu('settings')[0] }}">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>{{ trans('admin.Dashboard') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('settings')[1] }}">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i>{{ trans('admin.Dashboard') }}</a></li>
            <li><a href="{{ url('admin/settings') }}"><i class="fa fa-cog"></i>{{ trans('admin.settings') }}</a>
            </li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('categories')[0] }}">
        <a href="#">
            <i class="fa fa-align-justify"></i> <span>{{ trans('admin.categories') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('categor')[1] }}">
            <li class=""><a href="{{ url('admin/categories') }}">

                    <i class="fa fa-globe"></i>{{ trans('admin.categories') }}</a></li>
            <li class=""><a href="{{ url(route('admin.categories.create')) }}"><i
                        class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>


    <li class="treeview {{ active_menu('product')[0] }}">
        <a href="#">
            <i class="fa fa-bars"></i> <span>{{ trans('admin.products') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('product')[1] }}">
            <li class=""><a href="{{ url('admin/products') }}"><i class="fa fa-globe"></i>{{ trans('admin.products') }}
                </a></li>
            <li class=""><a href="{{ url(route('admin.products.create')) }}"><i
                        class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('semesters')[0] }}">
        <a href="#">
            <i class="fa fa-align-justify"></i> <span>{{ trans('admin.semesters') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('semester')[1] }}">
            <li class=""><a href="{{ url('admin/semesters') }}"><i
                        class="fa fa-globe"></i>{{ trans('admin.semesters') }}</a></li>
            <li class=""><a href="{{ url(route('admin.semesters.create')) }}"><i
                        class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('users')[0] }}">
        <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.users') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('user')[1] }}">
            <li class=""><a href="{{ url('admin/users') }}"><i class="fa fa-globe"></i>{{ trans('admin.users') }}</a>
            </li>
            <li class=""><a href="{{ url(route('admin.users.create')) }}"><i
                        class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>


    <li class="treeview {{ active_menu('departments')[0] }}">
        <a href="#">
            <i class="fa fa-adn"></i> <span>{{ trans('admin.departments') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('department')[1] }}">
            <li class=""><a href="{{ url('admin/departments') }}"><i
                        class="fa fa-globe"></i>{{ trans('admin.departments') }}</a></li>
            <li class=""><a href="{{ url(route('admin.departments.create')) }}"><i
                        class="fa fa-plus"></i>{{ trans('admin.add') }}</a></li>
        </ul>
    </li>
    <li class="treeview {{ active_menu('orders')[0] }}">
        <a href="#">
            <i class="fa fa-bar-chart"></i> <span>{{ trans('admin.orders') }}</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('order')[1] }}">
            <li class=""><a href="{{ url('admin/orders') }}"><i class="fa fa-globe"></i>{{ trans('admin.orders') }}</a></li>
        </ul>
    </li>



</ul>
