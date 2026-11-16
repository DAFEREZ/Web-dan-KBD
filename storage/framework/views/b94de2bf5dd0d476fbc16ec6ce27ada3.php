<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - PKK Kemanggisan</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f3f4f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; width: 320px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        h1 { font-size: 1.25rem; margin: 0 0 1rem; text-align: center; }
        label { display: block; margin-top: .75rem; font-size: .875rem; }
        input { width: 100%; padding: .5rem; margin-top: .25rem; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; margin-top: 1rem; padding: .6rem; background: #0f766e; color: #fff; border: 0; border-radius: 4px; cursor: pointer; }
        .error { background: #fee2e2; color: #991b1b; padding: .5rem; border-radius: 4px; font-size: .85rem; margin-bottom: .5rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1>PKK Kelurahan Kemanggisan</h1>

        <?php if($errors->any()): ?>
            <div class="error"><?php echo e($errors->first()); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login.attempt')); ?>">
            <?php echo csrf_field(); ?>
            <label>Username
                <input type="text" name="username" value="<?php echo e(old('username')); ?>" required autofocus>
            </label>
            <label>Password
                <input type="password" name="password" required>
            </label>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\pkk-kemanggisan\resources\views/auth/login.blade.php ENDPATH**/ ?>