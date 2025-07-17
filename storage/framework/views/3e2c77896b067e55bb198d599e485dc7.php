<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📦 Orders Received</h2>

    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-info text-center">No orders received yet.</div>
    <?php else: ?>
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderId => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $order = $items->first()->order; ?>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Order #<?php echo e($order->id); ?></strong>
                        — <span class="badge bg-secondary text-uppercase"><?php echo e($order->status); ?></span><br>
                        <small>Retailer: <?php echo e($order->retailer->name); ?> | Placed: <?php echo e($order->created_at->format('d M Y H:i')); ?></small>
                    </div>
                    <form action="<?php echo e(route('wholesaler.orders.updateStatus', $order->id)); ?>" method="POST" class="d-flex">
                        <?php echo csrf_field(); ?>
                        <select name="status" class="form-select form-select-sm me-2">
                            <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>Processing</option>
                            <option value="shipped" <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                            <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                        </select>
                        <button class="btn btn-sm btn-success">✔ Update</button>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->product->name); ?></td>
                                    <td><?php echo e($item->quantity); ?></td>
                                    <td>UGX <?php echo e(number_format($item->price)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.wholesaler', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/wholesaler/orders/index.blade.php ENDPATH**/ ?>