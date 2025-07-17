<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📊 Order Reports & Analytics</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase text-muted">Total Orders</h5>
                    <h2 class="text-primary"><?php echo e($totalOrders); ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase text-muted">Delivered Orders</h5>
                    <h2 class="text-success"><?php echo e($deliveredOrders); ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase text-muted">Pending Orders</h5>
                    <h2 class="text-warning"><?php echo e($pendingOrders); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-dark shadow-sm">
        <div class="card-body text-center">
            <h5 class="card-title text-uppercase text-muted">Total Revenue</h5>
            <h2 class="text-dark">UGX <?php echo e(number_format($totalRevenue)); ?></h2>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>