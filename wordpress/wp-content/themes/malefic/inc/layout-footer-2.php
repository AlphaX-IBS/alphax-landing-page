<?php $protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype'); ?>

<footer class="inverse-wrapper">

	<div class="container inner2">
		<div class="widget text-center"> 
		
			<a href="<?php echo esc_url(home_url('/')); ?>">
				<img alt="logo" src="<?php echo esc_url(get_option('malefic_logo', EBOR_THEME_DIRECTORY . 'style/images/logo.png')); ?>" />
			</a>
			
			<div class="space30"></div>
			
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
				
					<?php echo wpautop(get_bloginfo('description')); ?>
					
					<div class="space30"></div>
					
					<ul class="social">
						<?php 
							for( $i = 1; $i < 6; $i++ ){
								if( get_option("footer_social_url_$i") ) {
									echo '<li>
										      <a href="' . esc_url(get_option("footer_social_url_$i"), $protocols) . '" target="_blank">
											      <i class="fa ' . esc_attr(get_option("footer_social_icon_$i")) . '"></i>
										      </a>
										  </li>';
								}
							} 
						?>
					</ul>
					
				</div><!-- /column --> 
			</div><!-- /.row --> 
		
		</div><!-- /.widget --> 
	</div><!-- /.container -->

	<div class="sub-footer">
		<div class="container inner">
			<?php echo wpautop(wp_kses_post(get_option('footer_copyright', '© 2017 Malefic. All rights reserved. Theme by tommusrhodus.'))); ?>
		</div><!-- /.container --> 
	</div><!-- /.sub-footer --> 
	
</footer>