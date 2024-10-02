<div class="top-menu">
    <div class="top-burger">
        <!-- <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.767 0.478098L12.9896 2.96829C14.2795 5.59551 16.4045 7.72055 19.0317 9.0104L21.5219 10.233C21.9455 10.441 22.1203 10.953 21.9124 11.3766C21.829 11.5464 21.6917 11.6837 21.5219 11.767L19.0317 12.9896C16.4045 14.2795 14.2795 16.4045 12.9896 19.0317L11.767 21.5219C11.5591 21.9455 11.047 22.1203 10.6234 21.9124C10.4536 21.829 10.3163 21.6917 10.233 21.5219L9.0104 19.0317C7.72055 16.4045 5.59551 14.2795 2.96829 12.9896L0.478098 11.767C0.0544807 11.5591 -0.12033 11.047 0.0876474 10.6234C0.170999 10.4536 0.308323 10.3163 0.478098 10.233L2.96829 9.0104C5.59551 7.72055 7.72055 5.59551 9.0104 2.96829L10.233 0.478098C10.441 0.0544807 10.953 -0.12033 11.3766 0.0876474C11.5464 0.170999 11.6837 0.308323 11.767 0.478098Z"></path>
        </svg> -->
        <i class="fa-solid fa-bars"></i>
        <span><?php echo __('Menu'); ?></span>
    </div>
    <div class="top-logo">
        <img class="top-logo-image" src="<?php bloginfo('template_url'); ?>/logo/logo.png" alt="<?php bloginfo('title'); ?>">
    </div>
    <div class="top-actions">
        <a class="btn-login-top" href="/wp-login.php"><span><?php echo __('Sign In'); ?></span> <i class="fa-solid fa-user"></i></a>
        <!-- <a class="btn-cart-top" href="/cart"><span>Cart</span> <i class="fa-solid fa-bag-shopping"></i> <div class="cart-count">0</div></a> -->
    </div>
</div>
<nav id="top-nav">
    <?php wp_nav_menu([
        'theme_location' => 'top-menu',
        'menu_class' => 'top-bar',
    ]); ?>
</nav>

<!-- <a href="<?php echo home_url('/') ?>"> <?php bloginfo('name'); ?> </a> -->