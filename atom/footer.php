<footer>
	<div class="footer-wrap">
		<div class="footer-part">
			<div class="footer-logo">
				<img
					src="<?php bloginfo('template_url'); ?>/logo/logo-footer.png"
					alt="<?php bloginfo('title'); ?>">
			</div>
			<div class="footer-social">
				<span><?php echo __('Social Media'); ?></span>
				<a href="<?php echo SOCIAL_X; ?>" class="footer-social-link"><i class="fa-brands fa-x-twitter"></i></a>
				<a href="<?php echo SOCIAL_INSTAGRAM; ?>" class="footer-social-link"><i class="fa-brands fa-facebook"></i></a>
				<a href="<?php echo SOCIAL_FACEBOOK; ?>" class="footer-social-link"><i class="fa-brands fa-instagram"></i></a>
				<a href="<?php echo SOCIAL_YOUTUBE; ?>" class="footer-social-link"><i class="fa-brands fa-youtube"></i></a>
			</div>

		</div>
		<div class="footer-part">
			<div class="footer-subscribe">
				<div class="title"><?php echo __('Subscribe'); ?></div>
				<div class="desc"><?php echo __('To Newslleter'); ?></div>
				<form onsubmit="return subscribeUser(event,'<?php echo wp_create_nonce('subscribe'); ?>');">
					<label><?php echo __('Email Address'); ?></label>
					<div class="subscribe-input">
						<input type="text" name="email" id="subscribe-email">
						<button><?php echo __('Subscribe'); ?></button>
						<i class="fa-regular fa-envelope"></i>
					</div>
					<p class="footer-policy">
						<?php echo __('We care about the protection of your data. Read our '); ?>
						<a href="/privacy-policy" class="policy-link" target="_blank"><?php echo __('Privacy Policy'); ?></a>.
					</p>
				</form>
			</div>
		</div>
	</div>
	<div class="rights">
		<div class="left">
			© <?php echo __('All rights reserved 2024.'); ?>
			<?php echo __('Powerd by Atomjoy.'); ?>
		</div>
		<?php wp_nav_menu([
			'theme_location' => 'footer-menu',
			'menu_class' => 'footer-bar',
		]); ?>
	</div>
</footer>
</body>

</html>