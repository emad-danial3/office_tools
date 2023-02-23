<?php $__env->startSection('page_title'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>

    <?php echo e(trans('admin.Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- ./col -->

















                <!-- ./col -->
















                <!-- ./col -->
















                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo e($userCount); ?></h3>


                            <p><?php echo e(trans('admin.users')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="<?php echo e(url('admin/users')); ?>" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> <?php echo e(trans('admin.More Info')); ?> </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?php echo e($departmentsCount); ?></h3>


                            <p><?php echo e(trans('admin.departments')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="<?php echo e(url('admin/departments')); ?>" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> <?php echo e(trans('admin.More Info')); ?> </a>
                    </div>
                </div>
                <!-- ./col -->


            </div>
            <div class="row">



















            </div>

        </div><!-- /.container-fluid -->
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\emad\desktop\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>