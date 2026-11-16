
<?php $__env->startSection('title', 'Audit Log'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Audit Log</h1>

    <form method="GET" action="<?php echo e(route('admin.audit')); ?>">
        <label>Filter aksi
            <select name="aksi" onchange="this.form.submit()">
                <option value="">Semua</option>
                <?php $__currentLoopData = $aksiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($a); ?>" <?php if(request('aksi') === $a): echo 'selected'; endif; ?>><?php echo e($a); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </label>
    </form>
    <p><small>200 catatan terakhir.</small></p>

    <table>
        <tr><th>Waktu</th><th>User</th><th>Aksi</th><th>Tabel</th><th>ID</th><th>Keterangan</th><th>IP</th></tr>
        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($log->waktu); ?></td>
                <td><?php echo e($log->user->username ?? '-'); ?></td>
                <td><?php echo e($log->aksi); ?></td>
                <td><?php echo e($log->tabel); ?></td>
                <td><?php echo e($log->record_id); ?></td>
                <td><?php echo e($log->keterangan); ?></td>
                <td><?php echo e($log->ip_address); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pkk-kemanggisan\resources\views/admin/audit.blade.php ENDPATH**/ ?>