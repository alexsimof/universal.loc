<!-- // создаем свою функцию вывода каждого комента -->
<?php
function universal_theme_comment( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}

	$classes = ' ' . comment_class( empty( $args['has_children'] ) ? '' : 'parent', null, null, false );
	?>

	<<?php echo $tag, $classes; ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) { ?>

		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        
    <?php } ?>

    <div class="comment-author-avatar">
        <?php
		if ( $args['avatar_size'] != 0 ) {
			echo get_avatar( $comment, $args['avatar_size'] );
		}
        ?>
    </div>

    <div class="comment-content">

        <div class="comment-author vcard">
            <?php
                printf(
                    __( '<cite class="comment-name">%s</cite>' ),
                    get_comment_author_link()
                );
            ?>
            <span class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php
                        printf(
                            __( '%1$s, %2$s' ),
                            get_comment_date('F jS'),
                            get_comment_time()
                        ); 
                    ?>
                </a>

                <?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>

            </span>
        </div>

        <?php if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation">
                <?php _e( 'Your comment is awaiting moderation.' ); ?>
            </em><br/>
        <?php } ?>

        <?php comment_text(); ?>

        <div class="comment-reply">
            <svg width="15" height="15" class="icon comment-reply-icon">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
            </svg>
            <?php
            comment_reply_link(
                array_merge(
                    $args,
                    array(
                        'add_below' => $add_below,
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth']
                    )
                )
            ); 
            ?>
        </div>
    </div>

    <?php if ( 'div' != $args['style'] ) { ?>
        </div>
    <?php } 
}
    ?>



<div class="container">
            <!-- //проверка на авторизацию пользователем -->
    <?php

        if ( post_password_required() ) {
            return;
        }

    ?>

    <div id="comments" class="comments-area">

    <!-- // Вы можете начать редактирование здесь - включая этот комментарий! -->
        
        <?php
        if ( have_comments() ) :
            ?>
            <div class="comments-header">
                <h2 class="comments-title">
                    <?php echo 'Коментарии ' . '<span class="comments-count">' . get_comments_number() . '</span>';?>
                </h2>
                <!-- .comments-title -->
                <a href="#comment" class="comments-add-button">
                    <svg width="18" height="18" class="icon comments-add-icon">
                        <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#pencil"></use>
                    </svg>
                    Добавить комментарий
                </a>
            </div>

            <?php the_comments_navigation(); ?>

            <ol class="comments-list">
                <?php
                    wp_list_comments(
                        array(
                            'style'      => 'ol',
                            'short_ping' => true,
                            'avatar_size' => 75,
                            'callback' => 'universal_theme_comment'
                        )
                    );
                ?>
            </ol><!-- .comment-list -->

            <?php the_comments_navigation();
                   // If comments are closed and there are comments, let's leave a little note, shall we?
            if ( ! comments_open() ) :
             ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'universal-example' ); ?></p>
          <?php
            endif;

        endif; // Check for have_comments().

        comment_form( array (

            'must_log_in'          => '<p class="must-log-in">' . 
		        sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '
            </p>',
            'title_reply'     => '',
            'logged_in_as'    => '',

            'comment_field' => '<div class="comment-form-comment">
                <label for="comment">' . _x( 'Что вы думаете на этот счет? ', 'noun' ) . '</label>
                <div class="comment-wrapper"> '. get_avatar( get_current_user_id(), 75) . '
                    <div class="comment-textarea-wrapper">
                        <textarea id="comment" name="comment" aria-required="true"></textarea>
                    </div>
                </div>
            </div>',
            'class_submit'         => 'comment-submit more',
            'label_submit' => 'Отправить',
            'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        ));
        ?>

    </div><!-- #comments -->


</div>
