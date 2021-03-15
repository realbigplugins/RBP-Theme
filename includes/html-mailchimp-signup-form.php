<?php
/**
 * The signup form to embed from Mailchimp.
 *
 * LIST: Real Big Plugins
 *
 * @since 1.2.0
 */

defined( 'ABSPATH' ) || die();
?>
<!-- Begin MailChimp Signup Form -->
<!--<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">-->
<div id="mc_embed_signup">
	<form action="//realbigmarketing.us4.list-manage.com/subscribe/post?u=82db87321b6e03e3d7c4d9445&amp;id=c5fdffab28"
	      method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
	      target="_blank" novalidate>
		<div id="mc_embed_signup_scroll">

			<div class="input-group">
				<div class="mc-field-group input-group-field">
					<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL"
					       placeholder="Email address" aria-label="Email address">
				</div>
				<div class="input-group-button">
					<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
				</div>
			</div>

			<div id="mce-responses" class="clear">
				<div class="response" id="mce-error-response" style="display:none"></div>
				<div class="response" id="mce-success-response" style="display:none"></div>
			</div>
			<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
			<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
			                                                                          name="b_82db87321b6e03e3d7c4d9445_c5fdffab28"
			                                                                          tabindex="-1" value=""></div>
		</div>
	</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
<script type='text/javascript'>(function ($) {
		window.fnames = new Array();
		window.ftypes = new Array();
		fnames[0] = 'EMAIL';
		ftypes[0] = 'email';
		fnames[1] = 'FNAME';
		ftypes[1] = 'text';
		fnames[2] = 'LNAME';
		ftypes[2] = 'text';
	}(jQuery));
	var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->