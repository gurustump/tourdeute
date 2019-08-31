
			<div class="ov-container OV_CONTAINER">
				<div class="vid-player-container ov VID_PLAYER_OV OV">
					<div class="vid-player-wrapper ov-inner-wrapper VID_PLAYER_WRAPPER">
						<?php /* <div class="vid-playing-next">
							<p>Playing next in <span class="next-play-countdown NEXT_PLAY_COUNTDOWN"></span> seconds:</p>
							<h3><a class="VID_NEXT_PAGE VID_NEXT_TITLE" href=""></a></h3>
							<a class="VID_NEXT_PAGE video-thumb" href="">
								<img class="VID_NEXT_THUMB" src="" alt="" />
							</a>
							<div class="actions">
								<a class="cancel CANCEL_AUTOPLAY">Cancel Autoplay</a>
								<a class="VID_NEXT_PAGE play-now" href="">Play Now</a>
							</div>
						</div> */ ?>
						<div id="video_player"></div>
						<input class="VID_PLAYER_CURRENT_ID" type="hidden" value="" autocomplete="off" />
						<?php /* <div class="hidden">
							<input class="VID_NEXT_ID" type="hidden" value="" />
							<input class="VID_CREDITS_TIMECODE" type="hidden" value="" />
						</div> */ ?>
					</div>
					<a href="#" class="ov-close OV_CLOSE">Close</a>
				</div>
			</div>
			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
				<div id="inner-footer" class="wrap cf">
					<div class="footer-logo">
						<a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a>
					</div>
					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
					<div class="social">
						<?php echo $testorama; ?>
						<a class="svg-container" target="_blank" href=""><?php echoSVG('icInstagram'); ?></a>
						<a class="svg-container" target="_blank" href=""><?php echoSVG('icTwitter'); ?></a>
						<a class="svg-container" target="_blank" href=""><?php echoSVG('icYoutube'); ?></a>
						<a class="svg-container" target="_blank" href=""><?php echoSVG('icFacebook'); ?></a>
					</div>
				</div>
			</footer>
		</div>
		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>
	</body>
</html> <!-- end of site. what a ride! -->
