
<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.orderShow')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <?php if($model): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">User NAME</th>
                        <th scope="col"><?php echo e($model->LAST_NAME); ?></th>
                        <th scope="col">User EMAIL ADDRESS</th>
                        <th scope="col"><?php echo e($model->EMAIL_ADDRESS); ?></th>
                    </tr>

                    <tr>
                        <th scope="col">User EMPLOYEE ID</th>
                        <th scope="col"><?php echo e($model->EMPLOYEE_ID); ?></th>
                        <th scope="col">Semester Title</th>
                        <th scope="col"><?php echo e($model->semester->name); ?></th>
                    </tr>

                    <tr>
                        <th scope="col">Department Title</th>
                        <th scope="col"><?php echo e($model->department->name); ?></th>
                        <th scope="col">Order Status</th>
                        <?php if($model->status == 'pending'): ?>
                            <th scope="col" class="text-primary h4">Pending</th>
                        <?php endif; ?>
                        <?php if($model->status == 'approve'): ?>
                            <th scope="col" class="text-success h4">Manger Approve</th>
                        <?php endif; ?>
                        <?php if($model->status == 'reject'): ?>
                            <th scope="col" class="text-danger h4"> Manger Reject</th>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <th scope="col">Date Added</th>
                        <th scope="col"><?php echo e($model->created_at); ?></th>
                    </tr>

                    </thead>
                </table>
            <?php endif; ?>
            <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">
                        <?php if(isset($model->OrderProducts)&&count($model->OrderProducts)>0): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center">الطلبات التي اختارها المستخدم</h3>
                                </div>

                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered" style="direction: rtl">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" class="text-right">الصنف</th>
                                            <th scope="col" class="text-right">الكمية</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $model->OrderProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($product)&&isset($product->product)&&count($product->product)>0): ?>
                                                <tr>
                                                    <th scope="row"><?php echo e($product->product[0]->id); ?></th>
                                                    <td><?php echo e($product->product[0]->title); ?></td>
                                                    <td><?php echo e($product->quantity); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8 ">
                                    <h3 class="box-title">No Data</h3>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="box-body">
                <div class="box">
                    <div class="box-body">
                        <?php if(isset($semesterProducts)&&count($semesterProducts)>0): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center"><span
                                            style="color: blue"> مجموع الطلبات الكلي فى  :  </span> <?php echo e($model->semester->name); ?>

                                        <span style="color: blue">   &nbsp; والتى وافق عليها المديرين</span></h3>
                                </div>

                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered" style="direction: rtl">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" class="text-right">الصنف</th>
                                            <th scope="col" class="text-right">الكمية الكلية</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $semesterProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($product)): ?>
                                                <tr>
                                                    <th scope="row"><?php echo e($product->product_id); ?></th>
                                                    <td><?php echo e($product->title); ?></td>
                                                    <td><?php echo e($product->total_count); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 ">
                            <br>
                            <table class="table table-striped" style="direction: rtl">
                                <thead>
                                <?php if($model): ?>
                                    <tr>
                                        <th scope="col" class="text-right">عدد الادارات التي طلبت وتم موافقة المدير</th>
                                        <th scope="col"
                                            class="text-right"><?php echo e($orderDepartmentsCount ?$orderDepartmentsCount:0); ?></th>
                                    </tr>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8 ">
                                            <h3 class="box-title">No Data</h3>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                <?php endif; ?>

                                </thead>
                            </table>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 ">
                            <?php if($model): ?>


                                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="<?php echo e(url('/printPDF')); ?>">
                                    <?php echo csrf_field(); ?>

                                    <input type="hidden" id="semester_id" name="semester_id" value="<?php echo e($model->semester_id); ?>">

                                    <button type="submit" class="btn btn-success">Print Excel</button>
                                    <br>
                                    <br>
                                    <br>
                                </form>







                            <?php endif; ?>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>


        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        var base_url = window.location.origin;
        $(document).ready(function () {
            $('.select2').select2();
            $("#printPDF").click(function () {
                var semester_id = $('#semester_id').val();
                let path = base_url + "/admin/order/printPDF";
                var object = {
                    "semester_id": semester_id,
                }
                $.ajax({
                    url: path,
                    type: 'POST',
                    cache: false,
                    data: JSON.stringify(object),
                    contentType: "application/json; charset=utf-8",
                    traditional: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    success: function (response) {
                        if (response) {
                           console.log(response)
                        }
                    },
                    error: function (response) {
                        console.log(response)
                        alert('error');
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\emad\desktop\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>