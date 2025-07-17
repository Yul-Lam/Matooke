<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📦 Your Orders from Wholesalers</h2>

    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-info text-center">You haven’t placed any orders from wholesalers yet.</div>
    <?php else: ?>
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <strong>Order #<?php echo e($order->id); ?></strong> — 
                    <span class="badge bg-secondary text-uppercase"><?php echo e($order->status); ?></span><br>
                    
                    <small class="text-muted">Placed on: <?php echo e($order->created_at->format('d M Y H:i')); ?></small>

                    <a href="<?php echo e(route('retailer.wholesaler.invoice', $order->id)); ?>" class="btn btn-sm btn-outline-secondary">🧾 Download Invoice</a>

                </div>
                <div class="card-body">
                    <p><strong>Delivery Address:</strong> <?php echo e($order->delivery_address); ?></p>
                    <p><strong>Total:</strong> UGX <?php echo e(number_format($order->total)); ?></p>
                    
                    <h6>Items:</h6>
                    <ul class="list-group">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo e($item->product->name); ?> (<?php echo e($item->product->grade); ?>) 
                                <span>Qty: <?php echo e($item->quantity); ?> × UGX <?php echo e(number_format($item->price)); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.retailer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/retailer/wholesaler_orders.blade.php ENDPATH**/ ?>