<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">🛒 Wholesaler Cart</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(empty($cart)): ?>
        <div class="alert alert-info text-center">Your wholesaler cart is empty.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Grade</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo e($item['name']); ?></td>
                        <td><?php echo e($item['grade']); ?></td>
                        <td>UGX <?php echo e(number_format($item['price'])); ?></td>
                        <td><?php echo e($item['quantity']); ?></td>
                        <td>UGX <?php echo e(number_format($subtotal)); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="fw-bold table-info">
                    <td colspan="4">Total</td>
                    <td>UGX <?php echo e(number_format($total)); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <form action="<?php echo e(route('retailer.wholesaler.cart.clear')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger">🗑 Clear Cart</button>
            </form>

            <a href="<?php echo e(route('retailer.wholesaler.checkout')); ?>" class="btn btn-success">✅ Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.retailer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/retailer/wholesaler_cart.blade.php ENDPATH**/ ?>