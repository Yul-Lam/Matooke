<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h2 class="text-center fw-bold text-primary mb-5">🛍 Wholesaler Coffee Products</h2>

    <?php if($products->isEmpty()): ?>
        <div class="alert alert-warning text-center">
            No products available from wholesalers at the moment.
        </div>
    <?php else: ?>
        <div class="row">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card shadow-sm w-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-success fw-bold"><?php echo e($product->name); ?></h5>
                            <p><strong>Grade:</strong> <?php echo e($product->grade); ?></p>
                            <p><strong>Quantity:</strong> <?php echo e($product->quantity); ?></p>
                            <p><strong>Price:</strong> UGX <?php echo e(number_format($product->price)); ?></p>

                            
                            <form method="POST" action="<?php echo e(route('retailer.wholesaler.cart.add')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                <button type="submit" class="btn btn-sm btn-primary mt-2 w-100">➕ Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.retailer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/retailer/wholesaler_products.blade.php ENDPATH**/ ?>