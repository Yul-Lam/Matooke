<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h2 class="text-center text-success mb-4">☕ Retailer Dashboard</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6 d-grid gap-3">

            <a href="<?php echo e(route('retailer.products')); ?>" class="btn btn-outline-dark btn-lg w-100">
                🛍 View Coffee Products
            </a>

            <a href="<?php echo e(route('retailer.cart')); ?>" class="btn btn-outline-primary btn-lg w-100">
                🛒 View Cart
            </a>

            <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-outline-success btn-lg w-100">
                📦 My Orders
            </a>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.retailer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/retailer/retailer.blade.php ENDPATH**/ ?>