<?php
/**
 * Functions
 */
load_theme_textdomain( 'naciente', get_template_directory() . '/assets/languages' );
// Add default posts and comments RSS feed links to <head>.
add_theme_support( 'automatic-feed-links' );
// Add support for a variety of post formats
add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );
// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
add_theme_support( 'post-thumbnails' );
// Custom Background
add_theme_support( 'custom-background' );
// Custom Header
add_theme_support( 'custom-header' );
// WooCommerce Support
add_theme_support( 'woocommerce' );
// Register sidebars
if( function_exists('register_sidebar') ) {
    register_sidebar(array('name'=> sprintf(__('Sidebar 1','naciente')), 'id' => 'sidebar-1'));
    register_sidebar(array('name'=> sprintf(__('Sidebar 2','naciente')), 'id' => 'sidebar-2'));
    register_sidebar(array('name'=> sprintf(__('Sidebar 3','naciente')), 'id' => 'sidebar-3'));
    register_sidebar(array('name'=> sprintf(__('Footer 1','naciente')), 'id' => 'footer-1'));
    register_sidebar(array('name'=> sprintf(__('Footer 2','naciente')), 'id' => 'footer-2'));
    register_sidebar(array('name'=> sprintf(__('Footer 3','naciente')), 'id' => 'footer-3'));
    register_sidebar(array('name'=> sprintf(__('Footer 4','naciente')), 'id' => 'footer-4'));
}
// Menus
add_theme_support( 'menus' );
function elite_menus() {
	register_nav_menus(
		array(
            'menu-primary'=> sprintf(__('Menu Primary', 'naciente')),
			'menu-head-1' => sprintf(__( 'Menu Header 1', 'naciente' )),
			'menu-foot-1' => sprintf(__( 'Menu Footer 1', 'naciente' )),
			'menu-foot-2' => sprintf(__( 'Menu Footer 2', 'naciente' )),
			'menu-foot-3' => sprintf(__( 'Menu Footer 3', 'naciente' )),
			'menu-foot-4' => sprintf(__( 'Menu Footer 4', 'naciente' ))
		)
	);
}
add_action( 'init', 'elite_menus' );
class naciente_walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $id = 1;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $prepend = '';
        $append = '';
        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

        if($depth != 0)
        {
            $description = $append = $prepend = "";
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'><span class="'.mb_strtolower( str_replace(' ', '', $item->title) ).'"></span>';
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= $description.$args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
    }
}
/**
 * Disqus Comments
 */
function disqus_lazyload() {
	wp_register_script('disqus', get_template_directory_uri() . '/assets/scripts/disqus_lazyload.js');
	wp_enqueue_script('disqus');
}
add_action('wp_footer', 'disqus_lazyload');
/**
 * Pagination
 */
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}
/**
 * Login
 */
function my_login_stylesheet() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/style.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/8elitelogo.png);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
/**
 * The formatted output of a list of pages.
 *
 * Displays page links for paginated posts (i.e. includes the "nextpage".
 * Quicktag one or more times). This tag must be within The Loop.
 *
 * The defaults for overwriting are:
 * 'next_or_number' - Default is 'number' (string). Indicates whether page
 *      numbers should be used. Valid values are number and next.
 * 'nextpagelink' - Default is 'Next Page' (string). Text for link to next page.
 *      of the bookmark.
 * 'previouspagelink' - Default is 'Previous Page' (string). Text for link to
 *      previous page, if available.
 * 'pagelink' - Default is '%' (String).Format string for page numbers. The % in
 *      the parameter string will be replaced with the page number, so Page %
 *      generates "Page 1", "Page 2", etc. Defaults to %, just the page number.
 * 'before' - Default is '<p id="post-pagination"> Pages:' (string). The html 
 *      or text to prepend to each bookmarks.
 * 'after' - Default is '</p>' (string). The html or text to append to each
 *      bookmarks.
 * 'text_before' - Default is '' (string). The text to prepend to each Pages link
 *      inside the <a> tag. Also prepended to the current item, which is not linked.
 * 'text_after' - Default is '' (string). The text to append to each Pages link
 *      inside the <a> tag. Also appended to the current item, which is not linked.
 *
 * @param string|array $args Optional. Overwrite the defaults.
 * @return string Formatted output in HTML.
 */
function custom_wp_link_pages( $args = '' ) {
    $defaults = array(
        'before' => '<div class="pagination">',
        'after' => '</div>',
        'text_before' => '',
        'text_after' => '',
        'next_or_number' => 'number', 
        'pagelink' => '%',
        'echo' => 1
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    $output = '';
    if ( $multipage ) {
        if ( 'number' == $next_or_number ) {
            $output .= $before;
            for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
                $j = str_replace( '%', $i, $pagelink );
                $output .= ' ';
                if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
                    $output .= _wp_link_page( $i );
                else
                    $output .= '<span class="current">';

                $output .= $text_before . $j . $text_after;
                if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
                    $output .= '</a>';
                else
                    $output .= '</span>';
            }
            $output .= $after;
        } else {
            if ( $more ) {
                $output .= $before;
                $i = $page - 1;
                if ( $i && $more ) {
                    $output .= _wp_link_page( $i );
                    $output .= $text_before . $previouspagelink . $text_after . '</a>';
                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                    $output .= _wp_link_page( $i );
                    $output .= $text_before . $nextpagelink . $text_after . '</a>';
                }
                $output .= $after;
            }
        }
    }

    if ( $echo )
        echo $output;

    return $output;
}
?>