
<footer class="footer" id="contacts">
  <div class="container">

    
    <div class="footer__grid">
      <div class="footer__brand">
        <a class="logo" href="<?php echo e(route('home')); ?>">
          LANDI<span class="logo__dot">.</span>BY
        </a>
        <p>Открытая площадка объявлений аренды и продажи строительной техники в Беларуси.</p>
      </div>

      <nav class="footer__col" aria-label="Разделы">
        <h4>Разделы</h4>
        <ul>
          <li><a href="<?php echo e(url('/#catalog')); ?>">Каталог</a></li>
          <li><a href="<?php echo e(route('rent.index')); ?>">Аренда</a></li>
          <li><a href="<?php echo e(route('sale.index')); ?>">Продажа</a></li>
          <li><a href="<?php echo e(route('news.index')); ?>">Новости</a></li>
        </ul>
      </nav>

      <nav class="footer__col" aria-label="Техника">
        <h4>Техника</h4>
        
        <ul>
          <li><a href="<?php echo e(route('rent.index', 9)); ?>">Экскаваторы</a></li>
          <li><a href="<?php echo e(route('rent.index', 4)); ?>">Погрузчики</a></li>
          <li><a href="<?php echo e(route('rent.index', 46)); ?>">Автокраны</a></li>
          <li><a href="<?php echo e(route('rent.index', 6)); ?>">Самосвалы</a></li>
        </ul>
      </nav>

      <div class="footer__col">
        <h4>Контакты</h4>
        <ul>
          <li><?php echo e(config('site.address')); ?></li>
          <li><a href="<?php echo e(config('site.phone_link')); ?>"><?php echo e(config('site.phone')); ?></a></li>
          <li><a href="mailto:<?php echo e(config('site.email')); ?>"><?php echo e(config('site.email')); ?></a></li>
          <li><?php echo e(config('site.work_hours')); ?></li>
        </ul>
      </div>
    </div>

    
    <div class="footer__bottom">
      <nav class="footer__legal" aria-label="Правовые документы">
        <a href="<?php echo e(route('legal.user-agreement')); ?>">Пользовательское соглашение</a>
        <a href="<?php echo e(route('legal.privacy-policy')); ?>">Политика обработки персональных данных</a>
        <a href="<?php echo e(route('legal.offer')); ?>">Публичная оферта</a>
      </nav>

      <p class="footer__legal-info">Зарегистрирован в реестре рекламораспространителей под номером 4682</p>
      <p class="footer__legal-owner">© <?php echo e(date('Y')); ?> LANDI.BY. ООО «[Название компании]», УНП [000000000]. Свидетельство о государственной регистрации выдано [Кем и когда]. В Торговом реестре РБ с [Дата].</p>
    </div>

  </div>
</footer><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/components/footer.blade.php ENDPATH**/ ?>