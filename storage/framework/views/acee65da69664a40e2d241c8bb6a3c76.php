<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">🛒 Wholesaler Checkout</h2>

    <?php $total = 0; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger text-center"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('retailer.wholesaler.checkout.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Grade</th>
                        <th>Quantity</th>
                        <th>Price (UGX)</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo e($item['name']); ?></td>
                            <td><?php echo e($item['grade']); ?></td>
                            <td><?php echo e($item['quantity']); ?></td>
                            <td>UGX <?php echo e(number_format($item['price'])); ?></td>
                            <td>UGX <?php echo e(number_format($subtotal)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr class="fw-bold table-info">
                        <td colspan="4">Total</td>
                        <td>UGX <?php echo e(number_format($total)); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mb-3">
            <label for="delivery_address" class="form-label">Delivery Address</label>
            <input type="text" name="delivery_address" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">✅ Place Order</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.retailer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/retailer/wholesaler_checkout.blade.php ENDPATH**/ ?>