<?php

function b2k_setup() {
  add_theme_support( 'title-tag' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'html5', ['script', 'style'] );
  remove_theme_support('custom-header');
  remove_theme_support('custom-background');

  load_theme_textdomain('b2k', get_template_directory() . '/languages');

  global $content_width;
  if (!isset($content_width)) {
    $content_width = 1280;
  }
}
add_action('after_setup_theme', 'b2k_setup' );


add_filter('use_widgets_block_editor', '__return_false');

function b2k_styles() {
  $ver = '2.6';

  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('global-styles');

  wp_register_style('b2k-style', get_stylesheet_uri(), array(), $ver);

  wp_register_style(
    'printer',
    get_stylesheet_directory_uri() . '/css/printer.css',
    array('b2k-style', ),
    $ver,
    'print');

  wp_register_style(
    'reflex',
    get_stylesheet_directory_uri() . '/css/reflex.css',
    array('b2k-style', ),
    $ver,
    'all');

  wp_enqueue_style('b2k-style');
  wp_enqueue_style('printer');
  wp_enqueue_style('reflex');

  if (!wp_style_is('genericons', 'registered')) {
    wp_register_style(
      'genericons',
      get_stylesheet_directory_uri() . '/genericons/genericons.css',
      array('b2k-style', ),
      $ver,
      'all');
  }

  if (!wp_style_is('genericons', 'enqueued')) {
    wp_enqueue_style('genericons');
  }
}
add_action('wp_enqueue_scripts', 'b2k_styles');


function b2k_scripts() {
  if (is_singular() && comments_open()) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'b2k_scripts');


function b2k_tags() {
  $posttags = get_the_tags();
  $tags = array();
  if ($posttags) {
    foreach ($posttags as $tag) {
      $tags[] = sprintf(
        '<a href="%s">#%s</a>',
        esc_url(get_tag_link($tag->term_id)),
        esc_html(mb_strtolower($tag->name))
      );
    }
  }
  echo '<span>'. implode('', $tags) . '</span>';
}


function b2k_get_counter($post_id) {
  $counter = get_post_meta($post_id, 'b2k_post_counter', true);
  if ($counter) {
    return intval($counter);
  }
  return 0;
}

function b2k_print_view_counter() {
  $counter = b2k_get_counter(get_the_ID());

  $formatted = $counter; // значение по умолчанию

  if ($counter >= 1000000) {
    $formatted = sprintf('%.1fM', $counter / 1000000.0);
  } elseif ($counter >= 1000) {
    $formatted = sprintf('%.1fK', $counter / 1000.0);
  }

  printf('<span class="view" title="%s">%s</span>',
    esc_attr(number_format($counter, 0, ',', ' ')),
    esc_html($formatted));
}

function b2k_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Right sidebar', 'b2k' ),
    'id'            => 'right-sidebar',
    'description'   => __( 'Add widgets here to appear in your sidebar.', 'b2k' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<div class="widget-title">',
    'after_title'   => '</div><div class="widget-body">',
  ));

  register_sidebar( array(
    'name'          => __('Title sidebar', 'b2k'),
    'id'            => 'title-sidebar',
    'description'   => __('Add widgets here to appear in your sidebar.', 'b2k'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1><div class="widget-body">',
  ));

  register_sidebar( array(
    'name'          => __('Bottom sidebar', 'b2k'),
    'id'            => 'bottom-sidebar',
    'description'   => __('Add widgets here to appear in your sidebar.', 'b2k'),
    'before_widget' =>  '<div id="%1$s" class="widget %2$s">',
    'after_widget'  =>  '</div></div>',
    'before_title'  =>  '<div class="widget-title">',
    'after_title'   =>  '</div><div class="widget-body">'));
}
add_action('widgets_init', 'b2k_widgets_init' );


function b2k_register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __('Header Menu', 'b2k'),
    )
  );
}
add_action('init', 'b2k_register_my_menus');


function b2k_comment_callback($comment, $args, $depth) {
?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-meta">
<?php
  $author = get_comment_author_link();
  $date = get_comment_date('j F Y');
  $time = get_comment_time();
  $wrote = __('wrote', 'b2k');

  printf('%s <span class="author">%s</span> (%s, %s)', $wrote, $author, $date, $time);
?>
            </div> <!-- .comment-meta -->

                        <div class="comment-content">
                <?php comment_text(); ?>
            </div> <!-- .comment-content -->

            <div class="comment-meta">
<?php
  comment_reply_link(array_merge($args, array(
    'reply_text' => __('reply', 'b2k'),
    'depth' => $depth,
    'max_depth' => $args['max_depth'])))
?>
            </div> <!-- .comment-meta -->
        </article> <!-- .comment -->
    </li>
<?php
}

function b2k_the_content($post) {
  the_content();
  return;

  if (is_singular()) {
    the_content();
    return;
  }

  $content = apply_filters('the_content', $post->post_content);
  $parts = get_extended($content);
  echo $parts['main'];
  if (!empty($parts['extended'])) {
    echo apply_filters('the_content_more_link', '<a href="' . get_permalink() . '"><span>Развернуть</span><span id="Loading">...</span></a>');
  }
  echo '<div style="display:none">';
//  echo apply_filters('the_content', $parts['extended']);
  echo '</div>';

}


function b2k_pre_get_posts($query) {
  if (is_search()) {
    $query->set('orderby', 'date');
  }
}
add_action('pre_get_posts', 'b2k_pre_get_posts');

// Убираем версию Wordpress
remove_action('wp_head', 'wp_generator');


function b2k_primary_grid() {
  echo "grid__col-lg-9 grid__col-12";
}


function b2k_secondary_grid() {
  echo "grid__col-lg-3 grid__col-12";
}
?>
