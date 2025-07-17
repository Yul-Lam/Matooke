<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wholesaler Dashboard | Golden Bean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <?php echo $__env->yieldContent('head'); ?>
</head>
<body class="bg-light">

    
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #5a7247, #8b5a2b);">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo e(route('wholesaler.dashboard')); ?>">Golden Bean Wholesaler</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                    aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('wholesaler.dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('wholesaler.products.index')); ?>">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('wholesaler.products.create')); ?>">Upload Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('wholesaler.orders.index')); ?>">Orders</a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-sm btn-outline-light ms-3">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <main class="container py-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/layouts/wholesaler.blade.php ENDPATH**/ ?>