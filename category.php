<?php get_header('post') ?>
<div class="container">
    <h1 class="category-title"><?php single_cat_title(); ?></h1>
    
    <div class="post-list">
        <?php
        global $post;

        $myposts = get_posts([ 
            'numberposts' => 0,
            'category'    => 0
        ]);

        if( $myposts ){
            foreach( $myposts as $post ){
                setup_postdata( $post );
                ?>
                <!-- Вывода постов, функции цикла: the_title и т.д. -->
                
                <div class="post-card">
                    <img src="
                    <?php 
                        if( has_post_thumbnail() ) {
                            echo the_post_thumbnail_url();
                        }
                        else {
                            echo get_template_directory_uri().'/assets/images/default-images.png" />';
                        }
                        ?>" class="post-card-thumb">
                    <div class="post-card-text">
                        <h2 class="post-card-title"><?php the_title(); ?></h2>
                        <p><?php echo mb_strimwidth(get_the_excerpt(), 0, 60, ' ... '); ?></p>
                        <div class="author">
                        <?php $author_id = get_the_author_meta('ID'); ?>
                        <img src="<?php echo get_avatar_url($author_id); ?>" alt="" class="author-avatar">
                            <div class="author-info">
                                <span class="author-name"><strong>имя автора</strong></span>
                                <span class="date"><?php the_time('j F');?></span>
                                <div class="comments">
                                    <svg width="19" height="15" class="icon comments-icon">
                                    <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                                    </svg>
                                    <span class="comments-counter"><?php comments_number( '0', '1', '%'); ?></span>
                                </div>
                                <div class="likes">
                                    <svg width="19" height="15" class="icon likes-icon">
                                    <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                                    </svg>
                                    <span class="likes-counter"><?php comments_number( '0', '1', '%'); ?></span>
                                </div>
                            </div>
                        <!-- /.author-info -->
                        </div>
                        <!-- /.author -->
                    </div>
                <!-- /.post-card-text -->
                </div>
                <!-- /.card -->
                

                <?php 
            }
        } else {
            // Постов не найдено
        }

        wp_reset_postdata(); // Сбрасываем $post
        ?>
    </div>
                <!-- /.posts-list -->
  
</div>
<!-- /.container -->
<?php get_footer() ?>