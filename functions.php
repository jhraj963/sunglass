<?php

register_nav_menus( array(
    'primary' => __( 'Top primary menu', 'sunglass' ),
    'secondary' => __( 'Secondary menu', 'sunglass' ),
    ) );

function wp_nav_menu_no_ul()
{
    $options = array(
        'echo' => false,
        'container' => false,
        'theme_location' => 'primary',
        'add_a_class'     => 'nav-item nav-link',
        'fallback_cb'=> 'default_page_menu'
    );

    $menu = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#','#^<li[^>]*>#','#</li>$#',
        '#</ul>$#'
    ), '', $menu);

}


function default_page_menu() {
   wp_list_pages('title_li=');
}

function add_additional_class_on_a($classes, $item, $args)
{
    if (isset($args->add_a_class)) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}

add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);


add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );
add_theme_support( 'widgets' );

function register_footer1_widget_area() {
    register_sidebar(
        array(
            'id' => 'footer-widget-area-1',
            'name' => esc_html__( 'Footer First Part', 'theme-domain' ),
            'description' => esc_html__( 'Your footer content', 'theme-domain' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        )
    );
    register_sidebar(
        array(
            'id' => 'footer-widget-area-2',
            'name' => esc_html__( 'Footer Second Part', 'theme-domain' ),
            'description' => esc_html__( 'Your footer content', 'theme-domain' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        )
    );
    register_sidebar(
        array(
            'id' => 'footer-widget-area-3',
            'name' => esc_html__( 'Footer Third Part', 'theme-domain' ),
            'description' => esc_html__( 'Your footer content', 'theme-domain' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        )
    );
}
add_action( 'widgets_init', 'register_footer1_widget_area' );

/* custome post type */

add_action('init','register_sunglass_post_type',0);
function register_sunglass_post_type(){
    $slider_labels=array(
        'name'=>__('Slider','sunglass'),
        'singular_name'=>__('Slider','sunglass'),
        'add_new'=>__('Add New Slider','sunglass'),
        'add_new_item'=>__('Add New Slider','sunglass'),
        'edit_item'=>__('Edit Slider','sunglass'),
        'new_item'=>__('New Slider','sunglass'),
        'view_item'=>__('View Slider','sunglass'),
        'search_item'=>__('Search Slider','sunglass'),
        'not_found'=>__('No Slider Found','sunglass'),
        'not_found_in_trash'=>__('No Slider Found in Trash','sunglass'),
        'parent_item_colon'=>__('Parent Slide:','sunglass'),
        'menu_name'=>__('Slides','sunglass'),
    );

    $slider_args=[
        'labels'=>$slider_labels,
        'description'=>__('Add your home page slides', 'sunglass'),
        'supports'=>array('title','thumbnail'),
        'public'=>true,
        'show_ui'=>true,
        'show_ui_menu'=>true,
        'menu_icon'=>get_stylesheet_directory_uri().'/images/slider.png',
        'show_in_nav_menu'=>true,
        'publicly_queryable'=>true,
        'exclude_from_search'=>true,
        'has_archive'=>false,
        'query_var'=>true,
        'can_export'=>true,
        'rewrite'=>true,
        'capability_type'=>'post'
    ];

    register_post_type('slider',$slider_args);
}


