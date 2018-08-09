<?php $additional = get_post_meta( $post->ID, '_ebor_meta_repeat_group', true ); ?>

<ul class="item-details">

	<li>
		<span><?php esc_html_e('Categories', 'malefic'); ?></span>
		<?php echo ebor_the_terms('portfolio_category', ', ', 'name'); ?>
	</li>
	
	<?php 
		if( $additional ){
			foreach( $additional as $index => $item ){
				echo '<li><span>';
				if( isset ( $item['_ebor_the_additional_title'] ) )
					echo wp_kses_post($item['_ebor_the_additional_title']);
				echo '</span> ';
				if( isset ( $item['_ebor_the_additional_detail'] ) )
					echo wp_kses_post($item['_ebor_the_additional_detail']);
				echo '</li>';
			}
		}
	?>
	
	<li>
		<span><?php esc_html_e('Share', 'malefic'); ?></span>
		<ul class="social">
			<li><a href="#" class="goodshare" data-type="fb"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#" class="goodshare" data-type="tw"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#" class="goodshare" data-type="pt"><i class="fa fa-pinterest-p"></i></a></li>
			<li><a href="#" class="goodshare" data-type="gp"><i class="fa fa-google-plus"></i></a></li>
		</ul><!-- /.social -->
	</li>

</ul>


<?php get_template_part('inc/content-single-portfolio', 'button'); ?>