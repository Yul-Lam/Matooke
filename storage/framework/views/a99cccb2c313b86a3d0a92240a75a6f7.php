<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #<?php echo e($order->id); ?></title>
    <style>
        body { font-family: sans-serif; }
        .title { font-size: 20px; font-weight: bold; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="section title">Invoice #<?php echo e($order->id); ?></div>
    <div class="section">
        <strong>Retailer:</strong> <?php echo e($order->retailer->name); ?><br>
        <strong>Delivery Address:</strong> <?php echo e($order->delivery_address); ?><br>
        <strong>Order Date:</strong> <?php echo e($order->created_at->format('d M Y H:i')); ?><br>
        <strong>Status:</strong> <?php echo e(ucfirst($order->status)); ?>

    </div>
    <div class="section">
        <table width="100%" border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Grade</th>
                    <th>Qty</th>
                    <th>Price (UGX)</th>
                    <th>Total (UGX)</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->product->name); ?></td>
                    <td><?php echo e($item->product->grade); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td><?php echo e(number_format($item->price)); ?></td>
                    <td><?php echo e(number_format($item->quantity * $item->price)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="4" align="right"><strong>Grand Total:</strong></td>
                    <td><strong>UGX <?php echo e(number_format($order->total)); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\dashboard\coffee-ordering-clean\resources\views/invoices/retailer-wholesaler.blade.php ENDPATH**/ ?>