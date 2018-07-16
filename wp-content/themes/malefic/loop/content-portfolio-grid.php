<?php 
	if(!( has_post_thumbnail() ))
		return false;
?>

<div class="cbp-item <?php echo ebor_the_terms('portfolio_category', ' ', 'slug'); ?>">
	<a href="<?php the_permalink(); ?>" class="cbp-caption cbp-singlePage">
	
		<div class="cbp-caption-defaultWrap"> 
			<?php the_post_thumbnail('large'); ?>
		</div>
		
		<div class="cbp-caption-activeWrap">
			<div class="cbp-l-caption-alignCenter">
				<div class="cbp-l-caption-body">
					<?php the_title('<p>', '</p>'); ?>
				</div>
			</div>
		</div>
		
	</a>
</div>