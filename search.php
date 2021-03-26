<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package universal-example
 */

get_header();
?>

<div class="container">
    <div class="main-records-title"><h2>Результаты поиска по запросу:</h2></div>
    <div class="main-records">
        <ul class="records-list">
            <?php while ( have_posts() ){ the_post(); ?>
            <!-- Вывода постов, функции цикла: the_title и т.д. -->
                <li class="records-item">

                    <img class="records-img" 
                    src="
                        <?php 
                    
                            if( has_post_thumbnail() ) {
                                echo the_post_thumbnail_url();
                            }
                            else {
                                echo get_template_directory_uri().'/assets/images/default-images.png" />';
                            }

                        ?>"
                    alt="<?php the_title(); ?>">

                    <div class="records-name">

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
                        
                        <h2 class="records-title"><?php the_title(); ?></h2>
                        <p class="records-description"><?php echo mb_strimwidth(get_the_excerpt(), 0, 160, ' ... '); ?></p>
                        <div class="records-info">
                            <span class="info-date"><?php the_time('j F');?></span>
                            <svg width="15" height="15" class="icon info-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                            </svg>
                            
                            <span class="info-count"> <?php comments_number( '0', '1', '%'); ?></span>
                            <svg width="15" height="15" class="icon info-likes-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                            </svg>
                            
                            <span class="info-likes-count"> <?php comments_number( '0', '1', '%'); ?></span>
                        </div>
                    </div>
                </li>

            <?php } ?>
            <?php if ( ! have_posts() ){ ?>
                Записей нет.
            <?php } ?>
        </ul>
        <?php get_sidebar('home-bottom'); ?>
    </div>
    <div class="search-pagination">
        <?php the_posts_pagination(array(
            
            'end_size' => 2,

        )); ?>
    
    </div>
</div>
<?php get_footer(); ?>