<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package koffisani
 */

if ( ! function_exists( 'koffisani_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function koffisani_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<i class="fa fa-calendar"></i> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
	

	$byline = '<i class="fa fa-user"></i> <a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';

        
        $categories = "";
        $tags = "";
	// Hide category and tag text for pages.
	//if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'koffisani' ) );
		if ( $categories_list /*&& koffisani_categorized_blog()*/ ) {
			$categories = $categories_list ; // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'koffisani' ) );
		if ( $tags_list ) {
			$tags =  $tags_list ; // WPCS: XSS OK.
		}
	//}

	
        $comm = get_comments_number();
        echo '<span>' . $posted_on . '</span> <span> ' . $byline . '</span>';
        if(!empty($categories) && 'post' === get_post_type()) 
            echo '<i class="fa fa-folder-open"></i> ' . $categories . ' ' ;
        
        if(!empty($tags) && 'post' == get_post_type())
            echo '<i class="fa fa-tag"></i> ' . $tags . ' ' ;
        if($comm) {
            echo '<span><i class="fa fa-comments"></i> 
                                <a href="' . get_comments_link() . '">' .  $comm ;
            echo $comm > 1 ? ' Commentaires' : ' Commentaire' ;
            echo "</a></span>";
        }
        if (! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comment-o"></i>';
		/* translators: %s: post title */
		echo "<a href='" . esc_url( get_permalink() ) . "#commentform' > Laisser un commentaire</a>";
		echo '</span>';
	}                
        edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'koffisani' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link"><i class="fa fa-edit"></i>',
		'</span>'
	); // WPCS: XSS OK.
        echo "";

}
endif;

if ( ! function_exists( 'koffisani_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function koffisani_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'koffisani' ) );
		if ( $categories_list && koffisani_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'koffisani' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'koffisani' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'koffisani' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'koffisani' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'koffisani' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function koffisani_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'koffisani_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'koffisani_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so koffisani_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so koffisani_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in koffisani_categorized_blog.
 */
function koffisani_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'koffisani_categories' );
}
add_action( 'edit_category', 'koffisani_category_transient_flusher' );
add_action( 'save_post',     'koffisani_category_transient_flusher' );

/**
 * Output a complete commenting form for use within a template.
 *
 * Most strings and form fields may be controlled through the $args array passed
 * into the function, while you may also choose to use the comment_form_default_fields
 * filter to modify the array of default fields if you'd just like to add a new
 * one or remove a single field. All fields are also individually passed through
 * a filter of the form comment_form_field_$name where $name is the key used
 * in the array of fields.
 *
 * @since 3.0.0
 * @since 4.1.0 Introduced the 'class_submit' argument.
 * @since 4.2.0 Introduced the 'submit_button' and 'submit_fields' arguments.
 * @since 4.4.0 Introduced the 'class_form', 'title_reply_before', 'title_reply_after',
 *              'cancel_reply_before', and 'cancel_reply_after' arguments.
 * @since 4.5.0 The 'author', 'email', and 'url' form fields are limited to 245, 100,
 *              and 200 characters, respectively.
 *
 * @param array       $args {
 *     Optional. Default arguments and form fields to override.
 *
 *     @type array $fields {
 *         Default comment fields, filterable by default via the 'comment_form_default_fields' hook.
 *
 *         @type string $author Comment author field HTML.
 *         @type string $email  Comment author email field HTML.
 *         @type string $url    Comment author URL field HTML.
 *     }
 *     @type string $comment_field        The comment textarea field HTML.
 *     @type string $must_log_in          HTML element for a 'must be logged in to comment' message.
 *     @type string $logged_in_as         HTML element for a 'logged in as [user]' message.
 *     @type string $comment_notes_before HTML element for a message displayed before the comment fields
 *                                        if the user is not logged in.
 *                                        Default 'Your email address will not be published.'.
 *     @type string $comment_notes_after  HTML element for a message displayed after the textarea field.
 *     @type string $id_form              The comment form element id attribute. Default 'commentform'.
 *     @type string $id_submit            The comment submit element id attribute. Default 'submit'.
 *     @type string $class_form           The comment form element class attribute. Default 'comment-form'.
 *     @type string $class_submit         The comment submit element class attribute. Default 'submit'.
 *     @type string $name_submit          The comment submit element name attribute. Default 'submit'.
 *     @type string $title_reply          The translatable 'reply' button label. Default 'Leave a Reply'.
 *     @type string $title_reply_to       The translatable 'reply-to' button label. Default 'Leave a Reply to %s',
 *                                        where %s is the author of the comment being replied to.
 *     @type string $title_reply_before   HTML displayed before the comment form title.
 *                                        Default: '<h3 id="reply-title" class="comment-reply-title">'.
 *     @type string $title_reply_after    HTML displayed after the comment form title.
 *                                        Default: '</h3>'.
 *     @type string $cancel_reply_before  HTML displayed before the cancel reply link.
 *     @type string $cancel_reply_after   HTML displayed after the cancel reply link.
 *     @type string $cancel_reply_link    The translatable 'cancel reply' button label. Default 'Cancel reply'.
 *     @type string $label_submit         The translatable 'submit' button label. Default 'Post a comment'.
 *     @type string $submit_button        HTML format for the Submit button.
 *                                        Default: '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />'.
 *     @type string $submit_field         HTML format for the markup surrounding the Submit button and comment hidden
 *                                        fields. Default: '<p class="form-submit">%1$s %2$s</a>', where %1$s is the
 *                                        submit button markup and %2$s is the comment hidden fields.
 *     @type string $format               The comment form format. Default 'xhtml'. Accepts 'xhtml', 'html5'.
 * }
 * @param int|WP_Post $post_id Post ID or WP_Post object to generate the form for. Default current post.
 */
function koffisani_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$html5    = 'html5' === $args['format'];
        
        $nameplaceholder = $req ? "Nom*" : "Nom";
        $emailplaceholder = $req ? "E-mail*" : "E-mail";
	$fields   =  array(
		'author' => '<div class="row"><div class="col-sm-4">'
            . '<input id="author" name="author" class="col-lg-4 col-md-4 form-control" placeholder="' . $nameplaceholder . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></div>',
		'email'  => '<div class="col-sm-4">'
            . '<input id="email" name="email" class="col-lg-4 col-md-4 form-control" placeholder="'. $emailplaceholder . '" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>',
		'url'    => '<div class="col-sm-4">'
            . '<input id="url" name="url" class="col-lg-4 col-md-4 form-control" placeholder="Site web" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></div></div>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <p><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p></p>',
		/** This filter is documented in wp-includes/link-template.php */
		'must_log_in'          => '<p class="must-log-in">' . sprintf(
		                              /* translators: %s: login URL */
		                              __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
		                              wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
		                          ) . '</p>',
		/** This filter is documented in wp-includes/link-template.php */
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf(
		                              /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
		                              __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
		                              get_edit_user_link(),
		                              /* translators: %s: user name */
		                              esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
		                              $user_identity,
		                              wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
		                          ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_form'           => 'comment-form',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'title_reply'          => __( 'Leave a Reply' ),
		'title_reply_to'       => __( 'Leave a Reply to %s' ),
		'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
		'title_reply_after'    => '</h3>',
		'cancel_reply_before'  => ' <small>',
		'cancel_reply_after'   => '</small>',
		'cancel_reply_link'    => __( 'Cancel reply' ),
		'label_submit'         => __( 'Post Comment' ),
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-lg btn-default" value="%4$s" />',
		'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
		'format'               => 'xhtml',
	);

	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	// Ensure that the filtered args contain all required default values.
	$args = array_merge( $defaults, $args );

	if ( comments_open( $post_id ) ) : ?>
		<?php
		/**
		 * Fires before the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_before' );
		?>
		<div id="respond" class="comment-respond">
			<?php
			echo $args['title_reply_before'];

			comment_form_title( $args['title_reply'], $args['title_reply_to'] );

			echo $args['cancel_reply_before'];

			cancel_comment_reply_link( $args['cancel_reply_link'] );

			echo $args['cancel_reply_after'];

			echo $args['title_reply_after'];

			if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
				echo $args['must_log_in'];
				/**
				 * Fires after the HTML-formatted 'must log in after' message in the comment form.
				 *
				 * @since 3.0.0
				 */
				do_action( 'comment_form_must_log_in_after' );
			else : ?>
				<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="<?php echo esc_attr( $args['class_form'] ); ?>"<?php echo $html5 ? ' novalidate' : ''; ?>>
					<?php
					/**
					 * Fires at the top of the comment form, inside the form tag.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_top' );

					if ( is_user_logged_in() ) :
						/**
						 * Filter the 'logged in' message for the comment form for display.
						 *
						 * @since 3.0.0
						 *
						 * @param string $args_logged_in The logged-in-as HTML-formatted message.
						 * @param array  $commenter      An array containing the comment author's
						 *                               username, email, and URL.
						 * @param string $user_identity  If the commenter is a registered user,
						 *                               the display name, blank otherwise.
						 */
						echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );

						/**
						 * Fires after the is_user_logged_in() check in the comment form.
						 *
						 * @since 3.0.0
						 *
						 * @param array  $commenter     An array containing the comment author's
						 *                              username, email, and URL.
						 * @param string $user_identity If the commenter is a registered user,
						 *                              the display name, blank otherwise.
						 */
						do_action( 'comment_form_logged_in_after', $commenter, $user_identity );

					else :

						echo $args['comment_notes_before'];

					endif;

					// Prepare an array of all fields, including the textarea
					$comment_fields = array( 'comment' => $args['comment_field'] ) + (array) $args['fields'];

					/**
					 * Filter the comment form fields, including the textarea.
					 *
					 * @since 4.4.0
					 *
					 * @param array $comment_fields The comment fields.
					 */
					$comment_fields = apply_filters( 'comment_form_fields', $comment_fields );

					// Get an array of field names, excluding the textarea
					$comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );

					// Get the first and the last field name, excluding the textarea
					$first_field = reset( $comment_field_keys );
					$last_field  = end( $comment_field_keys );

					foreach ( $comment_fields as $name => $field ) {

						if ( 'comment' === $name ) {

							/**
							 * Filter the content of the comment textarea field for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args_comment_field The content of the comment textarea field.
							 */
							echo apply_filters( 'comment_form_field_comment', $field );

							echo $args['comment_notes_after'];

						} elseif ( ! is_user_logged_in() ) {

							if ( $first_field === $name ) {
								/**
								 * Fires before the comment fields in the comment form, excluding the textarea.
								 *
								 * @since 3.0.0
								 */
								do_action( 'comment_form_before_fields' );
							}

							/**
							 * Filter a comment form field for display.
							 *
							 * The dynamic portion of the filter hook, `$name`, refers to the name
							 * of the comment form field. Such as 'author', 'email', or 'url'.
							 *
							 * @since 3.0.0
							 *
							 * @param string $field The HTML-formatted output of the comment form field.
							 */
							echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";

							if ( $last_field === $name ) {
								/**
								 * Fires after the comment fields in the comment form, excluding the textarea.
								 *
								 * @since 3.0.0
								 */
								do_action( 'comment_form_after_fields' );
							}
						}
					}

					$submit_button = sprintf(
						$args['submit_button'],
						esc_attr( $args['name_submit'] ),
						esc_attr( $args['id_submit'] ),
						esc_attr( $args['class_submit'] ),
						esc_attr( $args['label_submit'] )
					);

					/**
					 * Filter the submit button for the comment form to display.
					 *
					 * @since 4.2.0
					 *
					 * @param string $submit_button HTML markup for the submit button.
					 * @param array  $args          Arguments passed to `comment_form()`.
					 */
					$submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );

					$submit_field = sprintf(
						$args['submit_field'],
						$submit_button,
						get_comment_id_fields( $post_id )
					);

					/**
					 * Filter the submit field for the comment form to display.
					 *
					 * The submit field includes the submit button, hidden fields for the
					 * comment form, and any wrapper markup.
					 *
					 * @since 4.2.0
					 *
					 * @param string $submit_field HTML markup for the submit field.
					 * @param array  $args         Arguments passed to comment_form().
					 */
					echo apply_filters( 'comment_form_submit_field', $submit_field, $args );

					/**
					 * Fires at the bottom of the comment form, inside the closing </form> tag.
					 *
					 * @since 1.5.0
					 *
					 * @param int $post_id The post ID.
					 */
					do_action( 'comment_form', $post_id );
					?>
				</form>
			<?php endif; ?>
		</div><!-- #respond -->
		<?php
		/**
		 * Fires after the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_after' );
	else :
		/**
		 * Fires after the comment form if comments are closed.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_comments_closed' );
	endif;
}

/**
 * Display search form.
 *
 * Will first attempt to locate the searchform.php file in either the child or
 * the parent, then load it. If it doesn't exist, then the default search form
 * will be displayed. The default search form is HTML, which will be displayed.
 * There is a filter applied to the search form HTML in order to edit or replace
 * it. The filter is 'get_search_form'.
 *
 * This function is primarily used by themes which want to hardcode the search
 * form into the sidebar and also by the search widget in WordPress.
 *
 * There is also an action that is called whenever the function is run called,
 * 'pre_get_search_form'. This can be useful for outputting JavaScript that the
 * search relies on or various formatting that applies to the beginning of the
 * search. To give a few examples of what it can be used for.
 *
 * @since 2.7.0
 *
 * @param bool $echo Default to echo and not return the form.
 * @return string|void String when $echo is false.
 */
function koffisani_get_search_form( $echo = true ) {
	/**
	 * Fires before the search form is retrieved, at the start of get_search_form().
	 *
	 * @since 2.7.0 as 'get_search_form' action.
	 * @since 3.6.0
	 *
	 * @link https://core.trac.wordpress.org/ticket/19321
	 */
	do_action( 'pre_get_search_form' );

	$format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';

	/**
	 * Filter the HTML format of the search form.
	 *
	 * @since 3.6.0
	 *
	 * @param string $format The type of markup to use in the search form.
	 *                       Accepts 'html5', 'xhtml'.
	 */
	$format = apply_filters( 'search_form_format', $format );

	$search_form_template = locate_template( 'searchform.php' );
	if ( '' != $search_form_template ) {
		ob_start();
		require( $search_form_template );
		$form = ob_get_clean();
	} else {
		if ( 'html5' == $format ) {
			$form = '<form role="search" method="get" id="site-searchform" action="' . esc_url( home_url( '/' ) ) . '">
				<div><input type="search" id="s" class="input-text" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" />
				<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
                                </div>
                            </form>';
		} else {
			$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '">
				<div>
					<label class="screen-reader-text" for="s">' . _x( 'Search for:', 'label' ) . '</label>
					<input type="text" value="' . get_search_query() . '" name="s" id="s" />
					<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
				</div>
			</form>';
		}
	}

	/**
	 * Filter the HTML output of the search form.
	 *
	 * @since 2.7.0
	 *
	 * @param string $form The search form HTML output.
	 */
	$result = apply_filters( 'get_search_form', $form );

	if ( null === $result )
		$result = $form;

	if ( $echo )
		echo $result;
	else
		return $result;
}
