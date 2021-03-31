<?php get_header('post'); ?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
            
			get_template_part( 'template-parts/content', get_post_type() );
            

                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                
        endwhile; // End of the loop.
        ?>

	</main><!-- #main -->

<?php get_footer(); ?>