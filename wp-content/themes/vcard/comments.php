<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
<?php $textdoimain = 'vcard'; ?>
<?php if ( have_comments() ) : ?>
<div class="comments">
<h2><?php comments_number( __('0 Comments', $textdoimain), __('1 Comments', $textdoimain), __('% Comments', $textdoimain) ); ?></h2>
	<!-- COMMENTS -->		
	<div class="entriesContainer">
		<ul class="comments clearfix">
			<?php wp_list_comments('callback=vcard_theme_comment'); ?>
		</ul>
		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
			<nav class="navigation comment-navigation" role="navigation">		   
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'vcard' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'vcard' ) ); ?></div>
			</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><?php _e( 'Comments are closed.' , 'CNE' ); ?></p>
		<?php endif; ?>			
	</div>
</div>	
<?php endif; ?>		
		<!-- //COMMENTS -->
<!-- LEAVE A COMMENT -->
<div class="respond">
			<h2>Leave a comment</h2>
			
			<!--Reply form-->
			<div class="replyForm">
<?php
    if ( is_singular() ) wp_enqueue_script( "comment-reply" );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                'id_form' => 'comments_form',                                
                'title_reply'=> '',
                'fields' => apply_filters( 'comment_form_default_fields', array(
                    'author' => '<div class="inputColumns clearfix">
                    <div class="column1">
                    <input type="text" placeholder="Name *" value="" id="author" name="author" /></div>',   
                    'email' => '<div class="column2">
                    <input type="text" placeholder="Email *" value="" id="email" name="email" /></div></div>',
                    'wedsite' =>'<input type="text" placeholder="WebSite" value="" id="website" name="website" >',                                                                                  
                ) ),                                
                 'comment_field' => '<textarea name="comment"'.$aria_req.'  placeholder="Message *" id="comment" cols="45" rows="10" ></textarea>',                                                   
                 'label_submit' => 'Post Comment',
                 'comment_notes_before' => '',
                 'comment_notes_after' => '',               
        )
    ?>
    <?php comment_form($comment_args); ?>
</div><!-- //LEAVE A COMMENT -->
  </div>              