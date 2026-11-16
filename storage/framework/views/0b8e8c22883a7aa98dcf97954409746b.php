
<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Dashboard</h1>
    <p>Login sebagai <strong><?php echo e(auth()->user()->username); ?></strong>
       (role: <strong><?php echo e(auth()->user()->role->nama_role); ?></strong>)</p>
    <p>Login terakhir: <?php echo e(auth()->user()->last_login ?? '-'); ?></p>
    <p>Hak akses: <?php echo e(auth()->user()->role->deskripsi); ?></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pkk-kemanggisan\resources\views/dashboard.blade.php ENDPATH**/ ?>