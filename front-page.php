<?php get_header(); ?>

<main class="front-page-header">
    <div class="container">
        <div class="hero">
            <div class="left">
                <?php
                    global $post;

                    $myposts = get_posts([ 
                    	'numberposts' => 1,
                    	'category_name'  => 'javaScript, css, html, web design',
                    ]);

                    if( $myposts ){
                    	foreach( $myposts as $post ){
                    		setup_postdata( $post );
                    ?>
                    <img src="<?php the_post_thumbnail_url() ?>" alt="Изображение записи" class="post-thumb">
                    <?php $author_id = get_the_author_meta('ID'); ?>
                    <a href="<?php echo get_author_posts_url($author_id); ?>" class="author">
                        <img src="<?php echo get_avatar_url($author_id); ?>" alt="Аватар автора записи" class="avatar">
                        <div class="author-bio">
                            <span class="author-name"><?php the_author(); ?></span>
                            <span class="author-rank">Должность</span>
                        </div>
                    </a>
                    <div class="post-text">
                        <?php the_category(); ?>
                        <h2 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, ' ... '); ?></h2>
                        <a href="<?php echo get_the_permalink(); ?>" class="more">Читать далее</a>
                    </div>
            
                    <?php 
               	        }
                    } else {
               	        // Постов не найдено
                    }
                      wp_reset_postdata(); // Сбрасываем $post
                ?>
            </div>
            <div class="right">
                <h3 class="recommend">Рекомендуем</h3>
                <ul class="posts-list">
                    <?php
                    global $post;

                    $myposts = get_posts([ 
                    	'numberposts' => 5,
                        'offset' => 1,

                    ]);

                    if( $myposts ){
                    	foreach( $myposts as $post ){
                    		setup_postdata( $post );
                    ?>
                    <li class="post">
                        <?php the_category(); ?>
                        <a class="post-permalink" href="<?php echo get_the_permalink() ?>">
                            <h4 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, ' ... '); ?></h4>
                        </a>
                    </li>
                    <?php 
               	        }
                    } else {
               	        // Постов не найдено
                    }
                      wp_reset_postdata(); // Сбрасываем $post
                    ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<div class="container">
    <ul class="article-list">
        <?php
        global $post;

        $myposts = get_posts([ 
            'numberposts' => 4,
            'category_name' => 'articles',

        ]);

        if( $myposts ){
            foreach( $myposts as $post ){
                setup_postdata( $post );
        ?>
        <li class="article-item">
            
            <a class="article-permalink" href="<?php echo get_the_permalink() ?>">
                <h4 class="article-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, ' ... '); ?></h4>
            </a>
            <img class="article-thumbnail" src="<?php echo get_the_post_thumbnail_url(null, 'article-thumb'); ?>" alt="Изображение записи">
        </li>
        <?php 
            }
        } else {
            // Постов не найдено
        }
            wp_reset_postdata(); // Сбрасываем $post
        ?>
    </ul>
    <div class="main-grid">
        <ul class="article-grid">
            <?php		
            global $post;

            $query = new WP_Query( [
                'posts_per_page' => 7,
                'tag'=> 'популярное,popular',
            ] );

            if ( $query->have_posts() ) {

                $cnt = 0;

                while ( $query->have_posts() ) {
                    $query->the_post();

                    $cnt++;
                    switch ($cnt) {

                        // первый пост
                        case '1':
                            ?> 
                            <li class="article-grid-item article-grid-item-1">
                                <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                                    <span class="category-name">
                                    <!-- выводим первую категорию -->
                                    <?php $category = get_the_category(); echo $category[0]->name;?>
                                    </span>
                                    <h4 class="article-grid-title"><?php the_title(); ?></h4>
                                    <p class="article-grid-texte"><?php echo mb_strimwidth(get_the_excerpt(), 0, 120, ' ... '); ?></p>
                                    <div class="article-grid-info">
                                        <div class="article-grid-author">
                                            <?php $author_id = get_the_author_meta('ID'); ?>
                                            <img class="article-grid-avatar" src="<?php echo get_avatar_url($author_id); ?>" alt="Аватар автора записи">
                                            <span class="article-grid-name"><strong><?php the_author(); ?></strong>: 
                                            <?php echo mb_strimwidth(get_the_author_meta( 'description' ), 0, 30, ' ... '); ?></span>
                                        </div>
                                        <div class="article-grid-comments">
                                        <img class="comments-icon" src="<?php echo get_template_directory_uri() . '/assets/images/comment.svg'?>" alt="Иконка комментарий">
                                        <span class="comments-count"> <?php comments_number( '0', '1', '%'); ?></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php 
                            break; 
                            // второй пост
                        case '2': ?>
                            <li class="article-grid-item article-grid-item-2">
                                <img class="article-grid-thumb" src="<?php the_post_thumbnail_url(); ?>" alt="Изображение записи">
                                <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                                    <!-- выводим первую метку поста -->
                                    <span class="article-grid-tags">
                                        <?php $posttags = get_the_tags();
                                        if ( $posttags ) {
                                            echo $posttags[0]->name . ' ';
                                        }
                                        ?>
                                    </span>
                                    <!-- выводим категорию поста -->
                                    <span class="article-grid-category">
                                    <?php $category = get_the_category(); echo $category[0]->name;?></span>
                                    <h4 class="article-grid-title"><?php the_title(); ?></h4>
                                    <div class="article-grid-info">
                                        <div class="author">
                                            <?php $author_id = get_the_author_meta('ID'); ?>
                                            <img class="author-avatar" src="<?php echo get_avatar_url($author_id); ?>" alt="Аватар автора">
                                            <div class="author-info">
                                                <span class="author-info-name"><strong><?php the_author(); ?></strong></span>
                                                <div class="author-info-comments">
                                                    <span class="comments-date"><?php the_time('j F');?></span>
                                                    <img class="comments-icon" src="<?php echo get_template_directory_uri() . '/assets/images/comment-white.svg'?>" alt="Иконка комментарий">
                                                    <span class="comments-count"> <?php comments_number( '0', '1', '%'); ?></span>
                                                    <img class="likes-icon" src="<?php echo get_template_directory_uri() . '/assets/images/heart.svg'?>" alt="Иконка лайков сердечко">
                                                    <span class="likes-count"> <?php comments_number( '0', '1', '%'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php
                            break;
                            // третий пост
                        case '3': ?>
                            <li class="article-grid-item article-grid-item-3">
                                <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                                    <img class="article-thumb" src="<?php the_post_thumbnail_url();?>" alt="Изображение записи">
                                    <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 40, ' ... '); ?></h4>
                                </a>
                            </li>
                            <?php
                            break;
                            // остальные посты
                        default: ?>
                            <li class="article-grid-item article-grid-item-default">
                                <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                                    <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 20, ' ... '); ?></h4>
                                    <p class="article-grid-texte"><?php echo mb_strimwidth(get_the_excerpt(), 0, 50, ' ... '); ?></p>
                                    <span class="article-grid-date"><?php the_time('j F');?></span>
                                </a>
                            </li>
                            <?php
                            break;
                    }
                    ?>
                    <!-- Вывода постов, функции цикла: the_title() и т.д. -->
                    <?php 
                }
            } else {
                // Постов не найдено
            }
            wp_reset_postdata(); // Сбрасываем $post
            ?>
        </ul>
        <?php get_sidebar(); ?>
    </div>
</div>

