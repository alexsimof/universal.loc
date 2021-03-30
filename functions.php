<?php

//   Добавляем расширенные возможности
if ( ! function_exists( 'universal_theme_setup' ) ) :

    function universal_theme_setup() {
        // title-tag
        add_theme_support( 'title-tag' );

        // Миниатюры
        add_theme_support( 'post-thumbnails', array( 'post' ) );

        // logo
        add_theme_support( 'custom-logo', [
            'width'      => 163,
            'flex-height' => true,
            'header-text' => 'Universal',
            'unlink-homepage-logo' => true, // WP 5.5
        ] );
        // menu
        register_nav_menus( [
            'header_menu' => 'Меню в шапке',
            'footer_menu' => 'Меню в подвале'
        ] );

    }
endif;
add_action( 'after_setup_theme', 'universal_theme_setup' );

// регестрируем свой тип постов

add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type( 'lesson', [
		'label'  => null,
		'labels' => [
			'name'               => 'Уроки', // основное название для типа записи
			'singular_name'      => 'Урок', // название для одной записи этого типа
			'add_new'            => 'Добавить урок', // для добавления новой записи
			'add_new_item'       => 'Добавление урока', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование урока', // для редактирования типа записи
			'new_item'           => 'Новый урок', // текст новой записи
			'view_item'          => 'Смотреть уроки', // для просмотра записи этого типа.
			'search_items'       => 'Искать уроки', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Уроки', // название меню
		],
		'description'         => 'Раздел с видеоуроками',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => true, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-learn-more',
		'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks',,'comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}



//  Регистрация виджета.
 
function universal_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар на главной', 'universal-theme' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Добавте виджет сюда...', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-top-title">',
			'after_title'   => '</h2>',
		)
	);
    register_sidebar(
		array(
			'name'          => esc_html__( 'Недавно опубликовано', 'universal-theme' ),
			'id'            => 'post-sidebar',
			'description'   => esc_html__( 'Добавте виджет сюда...', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-bottom-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Меню в подвале', 'universal-theme' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Добавте меню сюда...', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="footer-menu %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-menu-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Текст в подвале', 'universal-theme' ),
			'id'            => 'sidebar-footer-text',
			'description'   => esc_html__( 'Добавте текст сюда...', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="footer-text %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар в подвале записи', 'universal-theme' ),
			'id'            => 'sidebar-post',
			'description'   => esc_html__( 'Добавте виджет сюда...', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="sidebar-footer-post %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}
add_action( 'widgets_init', 'universal_theme_widgets_init' );


/**
 *          ------------------Добавление нового виджета Footer_Posts.---------------
 */
class Footer_Posts extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'footer_posts', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: footer_posts
			'Записи в футоре поста',
			array( 'description' => 'Записи в футоре поста', 'classname' => 'widget-footer-post', )
		);

		// скрипты/стили виджета, только если он активен

		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_footer_posts_scripts' ));
			add_action('wp_head', array( $this, 'add_footer_posts_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {

		$param_cat = $instance['cat_id']; // Узнаем ID категории
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;
		
		echo $args['before_widget'];

		if ( ! empty($number ) ) {
			
			global $post;
			$postslist = get_posts( array( 'posts_per_page' => $number, 'order'=> 'ASC', 'orderby' => 'title' ) );
			foreach ( $postslist as $post ){
				setup_postdata($post);
				?>
				
				<a href="<?php the_permalink(); ?>" class="footer-post-link">
					<img class="footer-img" src="<?php echo get_the_post_thumbnail_url( null, 'medium' ); ?>" alt="">
					<h3 class="footer-post-title"> <?php echo mb_strimwidth(get_the_title(), 0, 35, ' ... '); ?></h3>
					
					<div class="footer-block-info">

						<svg width="15" height="10" class="icon info-footer-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#eye"></use>
                        </svg>
						<span class="info-footer-count"> <?php comments_number( '0', '1', '%'); ?></span>
						
						<svg width="15" height="15" class="icon info-footer-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                        </svg>
						<span class="info-footer-count"> <?php comments_number( '0', '1', '%'); ?></span>

					</div>
				
				</a>
				
				<?php
			}
			wp_reset_postdata();
			
		}
		
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$cat = @ $instance['cat_id'] ?: '5'; 'Введите категорию';
		$number = @ $instance['number'] ?: '4';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'ID Категории:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'cat_id' ); ?>" name="<?php echo $this->get_field_name( 'cat_id' ); ?>" type="text" value="<?php echo esc_attr( $cat ); ?>">
		</p>
		
        <p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Количество записей:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		

		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['cat_id'] = ( ! empty( $new_instance['cat_id'] ) ) ? strip_tags( $new_instance['cat_id'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
		
		return $instance;
	}

	// скрипт виджета
	function add_footer_posts_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_footer_posts_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Footer_Posts
// регистрация Footer_Posts в WordPress

	function register_footer_posts() {
		
		register_widget( 'Footer_Posts' ); 
	}

add_action( 'widgets_init', 'register_footer_posts' );

// ******-------конец footer-Posts




        //   ------------------Добавление нового виджета Recent_Posts.---------------

class Recent_Posts extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'recent_posts', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: recent_posts
			'Недавние посты',
			array( 'description' => 'Недавние посты', 'classname' => 'widget-recent-posts', )
		);

		// скрипты/стили виджета, только если он активен

		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_recent_posts_scripts' ));
			add_action('wp_head', array( $this, 'add_recent_posts_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {

		$title = $instance['title'];
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		

		echo $args['before_widget'];
		
		if ( ! empty($number ) ) {
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			global $post;
			$postslist = get_posts( array( 'posts_per_page' => $number, 'order'=> 'ASC', 'orderby' => 'title' ) );
			foreach ( $postslist as $post ){
				setup_postdata($post);
				?>
				
				<a href="<?php the_permalink(); ?>" class="widget-post">
					<img class="widget-img" src="<?php echo get_the_post_thumbnail_url( null, 'thumbnail' ); ?>" alt="">
					<div class="widget-info">

						<h4 class="widget-post-title"> <?php echo mb_strimwidth(get_the_title(), 0, 30, ' ... '); ?></h4>
						<span class="widget-post-time">
							<?php
								$time_diff = human_time_diff( get_post_time('U'), current_time('timestamp') );
								echo "$time_diff назад.";
								//> Опубликовано 5 лет назад.
							?>
						</span>

					</div>
				
				</a>
				
				<?php
			}
			wp_reset_postdata();
			
		}
		
		
		
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Введите заголовок';
		$number = @ $instance['number'] ?: '5';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Количество записей:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		

		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
		
		return $instance;
	}

	// скрипт виджета
	function add_recent_posts_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_recent_posts_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

}
// конец класса Recent_Posts

// регистрация Recent_Posts в WordPress

	function register_recent_posts() {
		register_widget( 'Recent_Posts' );
	}
add_action( 'widgets_init', 'register_recent_posts' );

// ******-------конец Recent-Posts



/**
 * ------------------Добавление нового виджета Social_Widget (Социальные сети).---------------
 */
class Social_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'social_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: social_widget
			'Социальные сети',
			array( 'description' => 'Социальные сети', 'classname' => 'widget-social', )
		);

		// скрипты/стили виджета, только если он активен

		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_social_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_social_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {

		$title = $instance['title'];
		$facebook = $instance['facebook'];
		$instagram = $instance['instagram'];
		$twitter = $instance['twitter'];
		$youtube = $instance['youtube'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
        if ( ! empty( $facebook ) ) {
			echo '<a target= "_blank" class="widget-link-facebook" href="' . $facebook . '">
			<img src="' . get_template_directory_uri() . '/assets/images/facebook.svg" alt="Иконка фейсбука" class="widget-social-facebook"></a>';
		}
		if ( ! empty( $instagram ) ) {
			echo '<a target= "_blank" class="widget-link-insta" href="' . $instagram . '">
			<img src="' . get_template_directory_uri() . '/assets/images/insta.png" alt="Иконка фейсбука" class="widget-social-insta"></a>';
		}
		if ( ! empty( $twitter ) ) {
			echo '<a target= "_blank" class="widget-link-twitter" href="' . $twitter . '">
			<img src="' . get_template_directory_uri() . '/assets/images/twitter.svg" alt="Иконка твитера" class="widget-social-twitter"></a>';
		}
		if ( ! empty( $youtube ) ) {
			echo '<a target= "_blank" class="widget-link-youtube" href="' . $youtube . '">
			<img src="' . get_template_directory_uri() . '/assets/images/youtube.svg" alt="Иконка ютюба" class="widget-social-youtube"></a>';
		}
		
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Введите заголовок';
		$facebook = @ $instance['facebook'] ?: 'https://facebook.com';
		$instagram = @ $instance['instagram'] ?: 'https://instagram.com';
		$twitter = @ $instance['twitter'] ?: 'https://twitter.com';
		$youtube = @ $instance['youtube'] ?: 'https://youtube.com';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Ссылка на Facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Ссылка на Instagram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>">
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Ссылка на Twitter:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">
        </p>
		<p>
            <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Ссылка на Youtube:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>">
        </p>

		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
		$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
		$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_social_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_social_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Social_Widget

// регистрация Social_Widget в WordPress

	function register_social_widget() {
		register_widget( 'Social_Widget' );
	}

add_action( 'widgets_init', 'register_social_widget' );

// ******-------конец Social_Widget


/**
 *           -----------------Добавление нового виджета Downloader_Widget (Полезные файлы).-------------------
 */
class Downloader_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'downloader_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: downloader_widget
			'Полезные файлы',
			array( 'description' => 'Файлы для скачивания', 'classname' => 'widget-downloader', )
		);

		// скрипты/стили виджета, только если он активен

		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_downloader_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_downloader_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {

		$title = $instance['title'];
		$description = $instance['description'];
		$link = $instance['link'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
        if ( ! empty( $description ) ) {
			echo '<p class="widget-description">' . $description . '</p>';
		}
        if ( ! empty( $link ) ) {
			echo '<a target= "_blank" class="widget-link" href="' . $link . '">
			<img src="' . get_template_directory_uri() . '/assets/images/download.svg" alt="Иконка сайдбара скачать" class="widget-icon">
			Скачать</a>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Введите заголовок';
		$description = @ $instance['description'] ?: 'Описание';
		$link = @ $instance['link'] ?: 'https://google.com';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Описание:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Ссылка на файл:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
        </p>

		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_downloader_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_downloader_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Downloader_Widget

// регистрация downloader_widget в WordPress

function register_downloader_widget() {
	register_widget( 'Downloader_Widget' );
}
add_action( 'widgets_init', 'register_downloader_widget' );



// Подключение стилей и скиптов

function enqueue_universal_theme() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'swiper-slider', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', 'style');
    wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style');
    wp_enqueue_style( 'Roboto-Slab', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap');
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//code.jquery.com/jquery-3.6.0.min.js');
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'swiper-slider', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js' , null, time(), true);
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js' , 'swiper-slide', time(), true);

}
add_action( 'wp_enqueue_scripts', 'enqueue_universal_theme' );

// отключаем создание миниатюр файлов для указанных размеров

add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}
//    Регестрируем миниатюру
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'article-thumb', 65, 65, true ); // Кадрирование изображения
}

// создаем облоко тегов

add_filter('widget_tag_cloud_args', 'edit_widget_tag_cloud');
function edit_widget_tag_cloud($args){
	
	$args['unit'] = 'px';
	$args['smallest'] = '14';
	$args['largest'] = '14';
	$args['number'] = '12';
	$args['order'] = 'RAND';

	return $args;
};
// ..меняем конструкцию в конце отрывка [...] 

add_filter('excerpt_more', function($more) {
	return ' ...';
});

// ..сокращаем длину отрывка записи
add_filter( 'excerpt_length', function(){
	return 25;
} );

// склоняем слова после числительных
function plural_form($number, $after) {
	$cases = array (2, 0, 1, 1, 1, 2);
	echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}


/* ..отправка формы */
add_action( 'wp_enqueue_scripts', 'adminAjax_data', 99 );
function adminAjax_data(){

	wp_localize_script( 'jquery', 'adminAjax',
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);

}

add_action( 'wp_ajax_contacts_form', 'ajax_form');
add_action( 'wp_ajax_nopriv_contacts_form', 'ajax_form');
function ajax_form() {
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];
	$contact_comment = $_POST['contact_comment'];
	$message = 'Пользователь оставил свои данные: ' . $contact_name;

	$headers = 'From: А. Симонов <alex.simon-ov@yandex.ru>' . "\r\n";
	$sent_message = wp_mail('alex.simonof@gmail.com', 'Новая заявка', $message, $headers);
	if ($sent_message) {
		echo 'Все получилось!';
	} else {
		echo 'Где-то ошибка';
	}

	// выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
	wp_die();
}