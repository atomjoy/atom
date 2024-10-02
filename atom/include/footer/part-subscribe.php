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