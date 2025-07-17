<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Retailer | Coffee SCM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">☕ Retailer Panel</a>
            <div class="ms-auto">
                <span class="text-light me-3"><?php echo e(Auth::user()->name ?? 'Retailer'); ?></span>
                <a href="<?php echo e(route('logout')); ?>" class="btn btn-sm btn-outline-light"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        
        <div class="mb-4">
            <div class="btn-group" role="group" aria-label="Wholesaler navigation">
                <a class="btn btn-outline-primary" href="<?php echo e(route('retailer.wholesaler.products')); ?>">🛍 Browse Wholesaler Products</a>
                <a class="btn btn-outline-success" href="<?php echo e(route('retailer.wholesaler.cart')); ?>">🛒 View Wholesaler Cart</a>
                <a class="btn btn-outline-info" href="<?php echo e(route('retailer.wholesaler.orders')); ?>">📦 View Wholesaler Orders</a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/layouts/retailer.blade.php ENDPATH**/ ?>