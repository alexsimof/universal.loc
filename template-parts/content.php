

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header <?php echo get_post_type(); ?>-header" 
		style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75)), url(
			<?php
				if( has_post_thumbnail() ) {
					echo the_post_thumbnail_url();
					}
					else {
						echo get_template_directory_uri().'/assets/images/default-images.png" />';
					}
			?>
		);">
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
				<!-- ссылка на главную -->
					<a href="<?echo get_home_url();?>" class="home-link">
						<svg width="18" height="17" class="home-icon">
							<use xlink:href="<?php echo get_template_directory_uri();?>/assets/images/sprite.svg#home"></use>
						</svg>На главную</a>
					<!-- навигация prev - next пост -->
					<?php
						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-prev"><svg width="15" height="7" class="icon prev-icon">
									<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#left-arrow"></use>
								</svg>' . esc_html__( 'Назад', 'universal-theme' ) . '</span>',

								'next_text' => '<span class="nav-next">' . esc_html__( 'Вперед', 'universal-theme' ) . '
									<svg width="15" height="7" class="icon next-icon">
										<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow"><use>
									</svg>
								</span>',
							)
						);
					?>
				</div>
				<div class="bookmark">
					<a href="#" class="bookmark-link">
						<svg width="21" height="27" class="icon bookmark-icon">
							<use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#bookmark"></use>
						</svg>
					</a>
				</div>
				<?php
					if ( is_singular() ) :
						the_title( '<h1 class="post-title">', '</h1>' );
					else :
						the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
				?>

				<?php the_excerpt(); ?>
					
				<div class="header-info">
					<svg width="14" height="14" class="icon info-clock-icon">
						<use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#clock"></use>
					</svg>
					<span class="info-date"><?php the_time('j F G:i');?></span>

					<svg width="15" height="15" class="icon info-comment-icon">
						<use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
					</svg>
					
					<span class="info-comment-count"> <?php comments_number( '0', '1', '%'); ?></span>

					<svg width="14" height="14" class="icon info-likes-icon">
						<use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
					</svg>
					
					<span class="info-likes-count"> <?php comments_number( '0', '1', '%'); ?></span>
				</div>
				<div class="post-author">
					<div class="post-author-info">
						<?php $author_id = get_the_author_meta('ID'); ?>
							<img src="<?php echo get_avatar_url($author_id); ?>" alt="Аватар: Симонов Александр" class="avatar">
							<span class="author-name"><?php the_author(); ?></span>
							<span class="author-rank">Должность</span>
							<span class="author-numer"> 
								<!-- выводим к-во статей -->
								<?php plural_form (count_user_posts($author_id),
									/* варианты написания для количества 1, 2 и 5 */
									array('статья','статьи','статей'));
								?></span>

					</div>

					<a href="<?php echo get_author_posts_url($author_id); ?>" class="post-author-link">Страница автора</a>

				</div>
				<!-- end post author -->
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

			
		</div>

	</div> <!-- .end container -->
</article>