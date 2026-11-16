<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?> - PKK Kemanggisan</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #f9fafb; color: #111827; }
        nav { background: #0f766e; color: #fff; padding: .6rem 1rem; display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; }
        nav a { color: #fff; text-decoration: none; }
        nav a:hover { text-decoration: underline; }
        nav .sp { flex: 1; }
        nav form { margin: 0; }
        nav button { cursor: pointer; padding: .25rem .6rem; }
        main { max-width: 1000px; margin: 1.5rem auto; padding: 0 1rem; }
        table { border-collapse: collapse; width: 100%; font-size: .9rem; background: #fff; }
        th, td { padding: .5rem; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { background: #f3f4f6; }
        .ok { background: #dcfce7; color: #166534; padding: .6rem; border-radius: 4px; margin-bottom: 1rem; }
        .err { background: #fee2e2; color: #991b1b; padding: .6rem; border-radius: 4px; margin-bottom: 1rem; }
        .err ul { margin: 0; padding-left: 1.2rem; }
        .btn { display: inline-block; padding: .4rem .8rem; background: #0f766e; color: #fff; border: 0; border-radius: 4px; text-decoration: none; cursor: pointer; font-size: .9rem; }
        .badge { padding: .1rem .5rem; border-radius: 999px; font-size: .75rem; }
        .on { background: #dcfce7; color: #166534; }
        .off { background: #fee2e2; color: #991b1b; }
        label { display: block; margin-top: .8rem; font-size: .9rem; }
        input[type=text], input[type=password], select { width: 100%; max-width: 360px; padding: .45rem; margin-top: .25rem; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        small { color: #6b7280; }
    </style>
</head>
<body>
<?php $role = auth()->user()->role->nama_role; ?>
<nav>
    <strong>PKK Kemanggisan</strong>
    <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>

    <?php if($role === 'admin'): ?>
        <a href="<?php echo e(route('admin.users')); ?>">Kelola User</a>
        <a href="<?php echo e(route('admin.audit')); ?>">Audit Log</a>
    <?php endif; ?>
    <?php if(in_array($role, ['ketua', 'sekretaris', 'bendahara', 'anggota'])): ?>
        <a href="<?php echo e(route('profil')); ?>">Profil Saya</a>
    <?php endif; ?>
    <?php if(in_array($role, ['ketua', 'sekretaris'])): ?>
        <a href="<?php echo e(route('anggota.index')); ?>">Data Anggota</a>
    <?php endif; ?>
    <?php if(in_array($role, ['ketua', 'bendahara'])): ?>
        <a href="<?php echo e(route('iuran.index')); ?>">Iuran</a>
    <?php endif; ?>

    <span class="sp"></span>
    <span><?php echo e(auth()->user()->username); ?> (<?php echo e($role); ?>)</span>
    <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button type="submit">Logout</button></form>
</nav>

<main>
    <?php if(session('ok')): ?>
        <div class="ok"><?php echo e(session('ok')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="err"><ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>
</main>
</body>
</html><?php /**PATH C:\laragon\www\pkk-kemanggisan\resources\views/layouts/app.blade.php ENDPATH**/ ?>