<div class="meta text-center">

	<span class="date"><?php the_time( get_option('date_format') ); ?></span>
	
	<span class="category"><?php the_category(', '); ?></span>
	
	<span class="comments"><a href="#"><i class="fa fa-comment-o"></i><?php comments_number( '0','1','%' ); ?></a></span>
	
</div>