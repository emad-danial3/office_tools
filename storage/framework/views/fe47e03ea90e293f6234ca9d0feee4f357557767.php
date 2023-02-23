<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">

    <li class="treeview <?php echo e(active_menu('settings')[0]); ?>">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span><?php echo e(trans('admin.Dashboard')); ?></span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="<?php echo e(active_menu('settings')[1]); ?>">
            <li><a href="<?php echo e(url('admin')); ?>"><i class="fa fa-dashboard"></i><?php echo e(trans('admin.Dashboard')); ?></a></li>
            <li><a href="<?php echo e(url('admin/settings')); ?>"><i class="fa fa-cog"></i><?php echo e(trans('admin.settings')); ?></a>
            </li>
        </ul>
    </li>

    <li class="treeview <?php echo e(active_menu('categories')[0]); ?>">
        <a href="#">
            <i class="fa fa-align-justify"></i> <span><?php echo e(trans('admin.categories')); ?></span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="<?php echo e(active_menu('categor')[1]); ?>">
            <li class=""><a href="<?php echo e(url('admin/categories')); ?>">

                    <i class="fa fa-globe"></i><?php echo e(trans('admin.categories')); ?></a></li>
            <li class=""><a href="<?php echo e(url(route('admin.categories.create'))); ?>"><i
                        class="fa fa-plus"></i><?php echo e(trans('admin.add')); ?></a></li>
        </ul>
    </li>


    <li class="treeview <?php echo e(active_menu('product')[0]); ?>">
        <a href="#">
            <i class="fa fa-bars"></i> <span><?php echo e(trans('admin.products')); ?></span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="<?php echo e(active_menu('product')[1]); ?>">
            <li class=""><a href="<?php echo e(url('admin/products')); ?>"><i class="fa fa-globe"></i><?php echo e(trans('admin.products')); ?>

                </a></li>
            <li class=""><a href="<?php echo e(url(route('admin.products.create'))); ?>"><i
                        class="fa fa-plus"></i><?php echo e(trans('admin.add')); ?></a></li>
        </ul>
    </li>

    <li class="treeview <?php echo e(active_menu('semesters')[0]); ?>">
        <a href="#">
            <i class="fa fa-align-justify"></i> <span><?php echo e(trans('admin.semesters')); ?></span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="<?php echo e(active_menu('semester')[1]); ?>">
            <li class=""><a href="<?php echo e(url('admin/semesters')); ?>"><i
                        class="fa fa-globe"></i><?php echo e(trans('admin.semesters')); ?></a></li>
            <li class=""><a href="<?php echo e(url(route('admin.semesters.create'))); ?>"><i
                        class="fa fa-plus"></i><?php echo e(trans('admin.add')); ?></a></li>
        </ul>
    </li>

    <li class="treeview <?php echo e(active_menu('users')[0]); ?>">
        <a href="#">
            <i class="fa fa-users"></i> <span><?php echo e(trans('admin.users')); ?></span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="<?php echo e(active_menu('user')[1]); ?>">
            <li class=""><a href="<?php echo e(url('admin/users')); ?>"><i class="fa fa-globe"></i><?php echo e(trans('admin.users')); ?></a>
            </li>
            <li class=""><a href="<?php echo e(url(route('admin.users.create'))); ?>"><i
                        class="fa fa-plus"></i><?php echo e(trans('admin.add')); ?></a></li>
        </ul>
    </li>


    <li class="treeview <?php echo e(active_menu('departments')[0]); ?>">
        <a href="#">
            <i class="fa fa-adn"></i> <span><?php echo e(trans('admin.departments')); ?></span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="<?php echo e(active_menu('department')[1]); ?>">
            <li class=""><a href="<?php echo e(url('admin/departments')); ?>"><i
                        class="fa fa-globe"></i><?php echo e(trans('admin.departments')); ?></a></li>
            <li class=""><a href="<?php echo e(url(route('admin.departments.create'))); ?>"><i
                        class="fa fa-plus"></i><?php echo e(trans('admin.add')); ?></a></li>
        </ul>
    </li>
    <li class="treeview <?php echo e(active_menu('orders')[0]); ?>">
        <a href="#">
            <i class="fa fa-bar-chart"></i> <span><?php echo e(trans('admin.orders')); ?></span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu" style="<?php echo e(active_menu('order')[1]); ?>">
            <li class=""><a href="<?php echo e(url('admin/orders')); ?>"><i class="fa fa-globe"></i><?php echo e(trans('admin.orders')); ?></a></li>
        </ul>
    </li>



</ul>
<?php /**PATH E:\emad\desktop\resources\views/admin/layouts/menu.blade.php ENDPATH**/ ?>