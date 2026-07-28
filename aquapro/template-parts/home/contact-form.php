<?php
/**
 * Reusable AJAX lead form (used in the hero card and the contact section).
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form class="aqua-form" data-aqua-form novalidate>
	<div class="aqua-field">
		<label for="aqua-name"><?php esc_html_e( 'Your name', 'aquapro' ); ?></label>
		<input id="aqua-name" name="name" type="text" required autocomplete="name">
	</div>
	<div class="aqua-field">
		<label for="aqua-phone"><?php esc_html_e( 'Phone', 'aquapro' ); ?></label>
		<input id="aqua-phone" name="phone" type="tel" autocomplete="tel" inputmode="tel">
	</div>
	<div class="aqua-field">
		<label for="aqua-email"><?php esc_html_e( 'Email (optional)', 'aquapro' ); ?></label>
		<input id="aqua-email" name="email" type="email" autocomplete="email">
	</div>
	<div class="aqua-field">
		<label for="aqua-message"><?php esc_html_e( 'How can we help?', 'aquapro' ); ?></label>
		<textarea id="aqua-message" name="message" rows="3"></textarea>
	</div>
	<!-- honeypot: hidden from users, catches bots -->
	<div class="aqua-hp" aria-hidden="true">
		<label><?php esc_html_e( 'Leave this field empty', 'aquapro' ); ?><input type="text" name="website" tabindex="-1" autocomplete="off"></label>
	</div>
	<button class="aqua-btn aqua-btn--accent aqua-btn--block" type="submit" data-aqua-submit><?php esc_html_e( 'Request Callback', 'aquapro' ); ?></button>
	<p class="aqua-form__status" role="status" aria-live="polite" data-aqua-status></p>
</form>
