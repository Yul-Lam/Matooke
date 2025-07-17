<?php $__env->startSection('content'); ?>
<h2 class="mb-4 text-center text-dark fw-bold">☕ Golden Bean Admin Dashboard</h2>

<div class="mb-3">
    <a href="<?php echo e(route('admin.reports.index')); ?>" class="btn btn-outline-info">📊 View Reports & Analytics</a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-bg-primary shadow-sm">
            <div class="card-body">
                <h5 class="card-title">📦 Total Orders</h5>
                <p class="display-6 fw-semibold"><?php echo e($totalOrders); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-bg-success shadow-sm">
            <div class="card-body">
                <h5 class="card-title">💰 Total Revenue</h5>
                <p class="display-6 fw-semibold">$<?php echo e(number_format($totalRevenue, 2)); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-bg-warning shadow-sm">
            <div class="card-body">
                <h5 class="card-title">👥 Total Customers</h5>
                <p class="display-6 fw-semibold"><?php echo e($totalCustomers); ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-bg-info shadow-sm">
            <div class="card-body">
                <h6 class="card-title">📬 Pending Orders</h6>
                <p class="h4"><?php echo e($pendingOrders); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-secondary shadow-sm">
            <div class="card-body">
                <h6 class="card-title">🚚 Shipped Orders</h6>
                <p class="h4"><?php echo e($shippedOrders); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-dark shadow-sm">
            <div class="card-body">
                <h6 class="card-title">📦 Delivered Orders</h6>
                <p class="h4"><?php echo e($deliveredOrders); ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Chart -->
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">📊 Order Status Overview</h5>
        <canvas id="ordersChart" height="100"></canvas>
    </div>
</div>

<!-- Quick Actions -->
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title">⚙ Quick Actions</h5>
        <div class="d-flex flex-wrap gap-3">
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-outline-primary">
                <i class="fas fa-shopping-cart"></i> Manage Orders
            </a>
            <a href="#" class="btn btn-outline-success">
                <i class="fas fa-boxes"></i> Manage Products
            </a>
            <a href="#" class="btn btn-outline-warning">
                <i class="fas fa-users"></i> Manage Users
            </a>
        </div>
    </div>
</div>

<div class="mb-4">
    <a href="<?php echo e(route('admin.export.orders')); ?>" class="btn btn-success">
        📥 Download All Orders CSV
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'Shipped', 'Delivered'],
            datasets: [{
                label: 'Number of Orders',
                data: [<?php echo e($pendingOrders); ?>, <?php echo e($shippedOrders); ?>, <?php echo e($deliveredOrders); ?>],
                backgroundColor: ['#f0ad4e', '#5bc0de', '#5cb85c']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Current Order Distribution'
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>