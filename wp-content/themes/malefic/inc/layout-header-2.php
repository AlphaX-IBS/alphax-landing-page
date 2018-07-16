<nav class="navbar nobg">
	<div class="container">
		<div class="navbar-inner">
		
			<div class="navbar-header">
			
				<div class="navbar-brand">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img alt="logo" src="<?php echo esc_url(get_option('malefic_logo', EBOR_THEME_DIRECTORY . 'style/images/logo.png')); ?>" />
					</a>
				</div>
				
				<div class="nav-bars-wrapper">
					<div class="nav-bars-inner">
						<div class="nav-bars" data-toggle="collapse" data-target=".navbar-collapse"><span></span></div>
					</div><!-- /.nav-bars-inner --> 
				</div><!-- /.nav-bars-wrapper --> 
				
			</div><!-- /.nav-header -->
		
			<div class="navbar-collapse collapse">
				<?php
					if ( has_nav_menu( 'primary' ) ){
						wp_nav_menu( 
							array(
							    'theme_location'    => 'primary',
							    'depth'             => 3,
							    'container'         => false,
							    'container_class'   => false,
							    'menu_class'        => 'nav navbar-nav',
							    'menu_id'           => 'menu-standard-navigation',
							    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							    'walker'            => new ebor_bootstrap_navwalker()
							)
						);
					} else {
						echo '<ul class="nav navbar-nav"><li><a href="'. admin_url('nav-menus.php') .'">Set up a navigation menu now</a></li></ul>';
					}
				?>
			</div><!--/.nav-collapse --> 
		
		</div><!--/.navbar-inner --> 
	</div><!--/.container --> 
</nav><!--/.navbar -->