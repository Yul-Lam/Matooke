<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📦 My Uploaded Products</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($products->isEmpty()): ?>
        <div class="alert alert-info text-center">No products uploaded yet.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Quantity</th>
                    <th>Price (UGX)</th>
                    <th>Uploaded At</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($p->name); ?></td>
                        <td><?php echo e($p->grade); ?></td>
                        <td><?php echo e($p->quantity); ?></td>
                        <td><?php echo e(number_format($p->price)); ?></td>
                        <td><?php echo e($p->created_at->format('d M Y')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.wholesaler', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/wholesaler/wholesaler.blade.php ENDPATH**/ ?>