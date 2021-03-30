

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header <?php echo get_post_type(); ?>-header" 
		style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75))">

		<div class="container">
			<div class="post-header-wrapper">
				<div class="post-header-nav">
					<!-- выводим категорию -->
					<?php
						foreach (get_the_category() as $category) {
							printf(
								'<a href="%s" class="category-link %s">%s</a>',
								esc_url( get_category_link( $category ) ),
								esc_html( $category -> slug ),
								esc_html( $category -> name ),
							);
						}
					?>
					
				</div>
				<div class="video">
					<?php
					$video_link = get_field('video_link');
					if ($video_link) {
						$video_link = explode('/', get_field('video_link'));
						if ($video_link[2] === 'vimeo.com') {
							echo ('<iframe src="https://player.vimeo.com/video/' . ($video_link[3]) . '" width="100%" height="400" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>');
						}elseif ($video_link) {
							$video_link = explode('?v=', get_field('video_link'));
							echo ('<iframe width="100%" height="400" src="https://www.youtube.com/embed/' . ($video_link[1]) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
						}
					}
					?>
					
				</div>
				<?php
					if ( is_singular() ) :
						the_title( '<h1 class="post-title">', '</h1>' );
					else :
						the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
				?>
					
				<div class="header-info">
					<svg width="14" height="14" class="icon info-clock-icon">
						<use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#clock"></use>
					</svg>
					<span class="info-date"><?php the_time('j F G:i');?></span>

				</div>
				
			</div>
			<!-- end wrapper -->
		</div>
		<!-- end container -->
	</header>
			<!-- end entry-header -->
	
	<div class="container">
		<div class="post-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'universal-theme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Страницы:', 'universal-theme' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>
		<!-- .entry-content -->
	

		<!--    Подвал поста    -->
		<div class="post-footer">
			<?php

				$tags_list = get_the_tag_list('', '  ');
				if ( $tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<span class="post-footer-links">' . esc_html__( '%1$s', 'universal-theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}

			?>
			<span class="divider"></span>

			<?php meks_ess_share(); ?>
		
		</div>
	</div> <!-- .end container -->
	
		
	<?php get_sidebar('footer-post'); ?>
	
</article>