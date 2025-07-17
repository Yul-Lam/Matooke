<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📤 Upload New Processed Coffee Product</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('wholesaler.products.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Grade</label>
            <input type="text" name="grade" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (UGX)</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">✅ Upload Product</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.wholesaler', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/wholesaler/products/create.blade.php ENDPATH**/ ?>