<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Golden Bean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <?php echo $__env->yieldContent('head'); ?>
</head>
<body class="bg-light">

    
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #5a7247, #8b5a2b);">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Golden Bean Admin</a>
            <div class="d-flex gap-2">
                
                <a href="<?php echo e(route('admin.reports.index')); ?>" class="btn btn-sm btn-outline-warning">
                    <i class="fas fa-chart-line"></i> Reports
                </a>

                
                <a href="<?php echo e(route('logout')); ?>" class="btn btn-sm btn-outline-light"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>
    </nav>

    
    <main class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/layouts/admin.blade.php ENDPATH**/ ?>