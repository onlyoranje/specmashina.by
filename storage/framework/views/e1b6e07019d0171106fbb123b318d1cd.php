<?php $__env->startSection('title', 'Войти в профиль — ' . config('site.name', 'LANDI.BY')); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('css/auth.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

  <section class="auth-page">
    <div class="auth-container">

      
      <a class="auth-logo" href="<?php echo e(url('/')); ?>" aria-label="LANDI.BY — на главную">
        LANDI<span class="auth-logo__accent">.BY</span>
      </a>

      <h1 class="auth-title">Войти в профиль</h1>

      
      <?php if(session('status')): ?>
        <p class="auth-status" role="status"><?php echo e(session('status')); ?></p>
      <?php endif; ?>

      <form method="POST" action="<?php echo e(route('login')); ?>" class="auth-form">
        <?php echo csrf_field(); ?>

        
        <div class="auth-field">
          <label class="auth-label" for="email">Электронная почта</label>
          <input id="email"
                 type="email"
                 name="email"
                 class="auth-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> auth-input--error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                 value="<?php echo e(old('email')); ?>"
                 placeholder="you@example.com"
                 required
                 autocomplete="email"
                 autofocus
                 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="email-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="auth-error" id="email-error" role="alert"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="auth-field">
          <label class="auth-label" for="password">Пароль</label>
          <input id="password"
                 type="password"
                 name="password"
                 class="auth-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> auth-input--error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                 placeholder="••••••••"
                 required
                 autocomplete="current-password"
                 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> aria-invalid="true" aria-describedby="password-error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="auth-error" id="password-error" role="alert"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="auth-row">
          <label class="auth-check" for="remember">
            <input class="auth-visually-hidden auth-check__input" type="checkbox" id="remember" name="remember" <?php if(old('remember')): echo 'checked'; endif; ?>>
            <span class="auth-check__box" aria-hidden="true"></span>
            <span class="auth-check__text">Запомнить меня</span>
          </label>

          <?php if(Route::has('password.request')): ?>
            <a class="auth-link" href="<?php echo e(route('password.request')); ?>">Забыли пароль?</a>
          <?php endif; ?>
        </div>

        
        <button type="submit" class="btn-auth">Войти</button>
      </form>

      
      <p class="auth-footer">
        Впервые на сайте?
        <a class="auth-footer__link" href="<?php echo e(route('register')); ?>">Зарегистрироваться</a>
      </p>

    </div>
  </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('redesign.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/auth/login.blade.php ENDPATH**/ ?>