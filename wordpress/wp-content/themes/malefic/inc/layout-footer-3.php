<?php $protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype'); ?>

<footer class="inverse-wrapper">

	<div class="container inner2">
		<div class="row">
			<?php
				if( is_active_sidebar('footer1') && !( is_active_sidebar('footer2') ) && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
					echo '<div class="col-sm-12">';
						dynamic_sidebar('footer1');
					echo '</div>';
				}
					
				if( is_active_sidebar('footer2') && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
					echo '<div class="col-sm-6">';
						dynamic_sidebar('footer1');
					echo '</div><div class="col-sm-6">';
						dynamic_sidebar('footer2');
					echo '</div><div class="clear"></div>';
				}
					
				if( is_active_sidebar('footer3') && !( is_active_sidebar('footer4') ) ){
					echo '<div class="col-sm-4">';
						dynamic_sidebar('footer1');
					echo '</div><div class="col-sm-4">';
						dynamic_sidebar('footer2');
					echo '</div><div class="col-sm-4">';
						dynamic_sidebar('footer3');
					echo '</div><div class="clear"></div>';
				}
				
				if( ( is_active_sidebar('footer4') ) ){
					echo '<div class="col-sm-3">';
						dynamic_sidebar('footer1');
					echo '</div><div class="col-sm-3">';
						dynamic_sidebar('footer2');
					echo '</div><div class="col-sm-3">';
						dynamic_sidebar('footer3');
					echo '</div><div class="col-sm-3">';
						dynamic_sidebar('footer4');
					echo '</div><div class="clear"></div>';
				}
			?>
		</div><!-- /.row --> 
	</div><!-- /.container -->
	
	<div class="sub-footer">
		<div class="container inner">
		
			<div class="cell text-left">
				<?php echo wpautop(wp_kses_post(get_option('footer_copyright', '© 2017 Malefic. All rights reserved. Theme by tommusrhodus.'))); ?>
			</div><!-- /.cell -->
			
			<div class="cell text-right">
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
			</div><!-- /.cell --> 
			
		</div><!-- /.container --> 
	</div><!-- /.sub-footer --> 

</footer>