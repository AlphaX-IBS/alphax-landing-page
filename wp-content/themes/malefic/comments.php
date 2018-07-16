<?php
	$custom_comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
		    'author' => '<div class="name-field">
		    			 <input type="text" id="author" name="author" placeholder="' . esc_html__('Name *','malefic') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" />
		    			 </div>',
		    'email'  => '<div class="email-field">
		    			 <input name="email" type="text" id="email" placeholder="' . esc_html__('Email *','malefic') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" />
		    			 </div>',
		    'url'    => '<div class="website-field">
		    			 <input name="url" type="text" id="url" placeholder="' . esc_html__('Website','malefic') . '" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" />
		    			 </div>') 
		),
		'comment_field' => '<div class="message-field">
							<textarea name="comment" placeholder="' . esc_html__('Comments *','malefic') . '" id="comment" aria-required="true"></textarea>
							</div>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf(__( 'Logged in as <a href="%1$s">%2$s</a> <a href="%3$s">Log out?</a>','malefic' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
		'cancel_reply_link' => esc_html__( 'Cancel' , 'malefic' ),
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'label_submit' => esc_html__( 'Submit' , 'malefic' )
	);
?>

<hr />

<div id="comments">

  <h4><?php comments_number( esc_html__('0 Comments','malefic'), esc_html__('1 Comment','malefic'), esc_html__('% Comments','malefic') ); ?> <?php esc_html_e('on','malefic'); ?> <?php the_title('"','"'); ?></h4>
  
	<?php 
		if( have_comments() ){
			echo '<ol id="singlecomments" class="commentlist">';
				wp_list_comments('type=comment&callback=ebor_custom_comment');
			echo '</ol>';
			paginate_comments_links();
		}
	?>
	
</div><!-- /#comments -->

<hr />

<div class="comment-form-wrapper">
	<h4><?php esc_html_e('Would you like to share your thoughts?', 'malefic'); ?></h4>
	<?php 
		echo wpautop(esc_html_e('Your email address will not be published. Required fields are marked *', 'malefic'));
		comment_form($custom_comment_form); 
	?>
</div><!-- /.comment-form-wrapper --> 