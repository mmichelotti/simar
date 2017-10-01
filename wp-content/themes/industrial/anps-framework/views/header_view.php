<?php
include_once(get_template_directory() . '/anps-framework/classes/AnpsOptions.php');

/* Enqueue style in script for custom colorpicker */
wp_enqueue_style('anps_colorpicker');
wp_enqueue_script('anps_colorpicker_theme');
wp_enqueue_script('anps_colorpicker_custom');

wp_enqueue_script('my-upload');
wp_enqueue_style("thickbox");


if (isset($_GET['save_options'])) {  
    $anps_options->anps_save_options("header");
}
?>

<form action="themes.php?page=theme_options&sub_page=header&save_options" method="post">
    <div class="content-inner">
        <div class="row">

            <div class="col-md-12">
                <h3><i class="fa fa-bars"></i><?php esc_html_e('Menu Layout options', 'industrial'); ?></h3>    
            </div>
            
            <div class="global-layout">

                <?php $radiooptions = array (
                    'classic-layout' => array (
                        'imgbefore' => '<div class="imagewrap">',
                        'image' => 'top-background-menu.jpg',
                        'imgafter' => '</div>',                  
                        'value' => 'classic-layout',
                    ),
                    'vertical-layout' => array (
                        'imgbefore' => '<div class="imagewrap">',
                        'image' => 'vertical-menu.jpg',
                        'imgafter' => '</div>',
                        'value' => 'vertical-layout',  
                    )                                   
                ); 

                $anps_options->anps_create_radio('anps_global_menu_type', $radiooptions, 'col-xs-6 headerstyles', true, "", "classic-layout", true );?>    
               
                <div class="options-to-toggle"> 

                    <div class="col-md-12 show-classic-layout onoff">

                        <h4><span>SET YOR HEADER OPTIONS</span></h4>
                        <p>You have 2 menu/header option to set. Each option has additional settings which corespond to its style, with different variations you can customise you menu/header in numerious ways.</p>
                    
                        <div class="row">
                        
                            <?php $horizontal_options = array (
                                'top' => array (
                                    'image' => 'top-background-menu.jpg',                  
                                    'value' => 'top',
                                ),
                                'style2' => array (
                                    'image' => 'top-style-2-background-menu.jpg',                  
                                    'value' => 'style2',
                                ),                                
                                'bottom' => array (
                                    'image' => 'bottom-background-menu.jpg',
                                    'value' => 'bottom',  
                                )           
                            ); 

                            $anps_options->anps_create_radio('anps_home_classic_menu_type', $horizontal_options, 'col-md-3 top-or-bottom', true, '', 'top' );?>    
                            
                            <div class="col-md-3 ">
                                <div class="bg-blue" data-minheight="140">
                                    <p> These options only apply to the home page. You can additionaly set the options on each page seperqtly, which will override options selected here. <br> Global options can be set in a section below. </p>
                                </div>  
                            </div>
                            <div class="clearfix"></div>

                            <div class="options-to-toggle">
                                <div class="col-md-12">
                                    <h4>SET YOR <span>HOME PAGE</span> MENU OPTION</h4>
                                </div>
                                <!-- Text color -->
                                <div class="col-md-4">
                                    <?php $anps_options->anps_create_color_option('anps_front_text_color', '', esc_html__('Text color', 'industrial') );?>
                                </div>

                                <!-- Background color -->
                                <div class="col-md-4 dimmreverse">
                                    <?php $anps_options->anps_create_color_option('anps_front_bg_color', '', esc_html__('Background color', 'industrial') );?>   
                                </div>

                                <!-- Text hover color -->
                                <div class="col-md-4">
                                    <?php $anps_options->anps_create_color_option('anps_front_text_hover_color', '', esc_html__('Text hover color', 'industrial') );?>
                                </div>

                                <!-- Above menu background color -->
                                <div class="col-md-4 onoff show-style2">
                                    <?php $anps_options->anps_create_color_option('anps_above_menu_bg_color', '', esc_html__('Above menu background color', 'industrial') );?>   
                                </div>
                               
                                <!-- Logo background color -->
                                <div class="col-md-4 onoff show-style2">
                                    <?php $anps_options->anps_create_color_option('anps_logo_bg_color', '', esc_html__('Logo background color', 'industrial') );?>   
                                </div>
                                                               
                                <!-- Menu centered checkbox -->
                                <div class="col-md-4 onoff show-top show-style2">
                                    <?php $anps_options->anps_create_checkbox('anps_front_menu_center', esc_html__('Menu centered', 'industrial') );?>
                                </div> 

                               <!-- top bar color -->
                                <div class="col-md-4 onoff show-top dimm">
                                    <?php $anps_options->anps_create_color_option('anps_front_topbar_color', '', esc_html__('Top bar color', 'industrial') );?>  
                                </div>

                                <!-- Menu transparent checkbox -->
                                <div class="col-md-4 dimm-master onoff show-top show-bottom">
                                    <?php $anps_options->anps_create_checkbox('anps_front_transparent_header', esc_html__('Transparent header', 'industrial') );?>
                                </div>
                                <!-- Menu height -->
                                <div class="col-md-4 dimm-master onoff show-top">
                                    <?php $anps_options->anps_create_number_option('anps_classic_header_height',"", esc_html__('Header height', 'industrial'), 'px',  esc_html__('Accepts values between 70 and 280', 'industrial') );?>
                                </div>

                                <!-- Set global checkbox -->
                                <div class="col-md-4 onoff show-top set-global show-style2">
                                    <?php $anps_options->anps_create_checkbox('anps_set_settings_as_global_header', esc_html__('Set this settings as global', 'industrial'), '0');?>
                                </div>
                            </div>

                            <div class="options-to-toggle show-style2">
                                <!-- Menu button checkbox -->
                                <div class="col-md-4 onoff dimm-master show-style2">
                                    <?php $anps_options->anps_create_checkbox('anps_menu_button', esc_html__('Menu button', 'industrial') );?>
                                </div> 

                                <!-- Menu button text -->
                                <div class="col-md-4 onoff dimm show-style2">
                                    <?php $anps_options->anps_create_text_option('anps_menu_button_text', esc_html__('Menu button text', 'industrial') );?>
                                </div> 

                                <!-- Menu button URL -->
                                <div class="col-md-4 onoff dimm show-style2">
                                    <?php $anps_options->anps_create_text_option('anps_menu_button_url', esc_html__('Menu button URL', 'industrial') );?>
                                </div> 
                            </div>
                        </div>    

                        <div class="row global-options">
                            
                            <div class="col-md-12 ">
                                <h4>SET YOR <span>GLOBAL MENU</span> OPTION</h4> 

                                <p>These options apply globaly - on all pages.  <span class="blue">For additional customization, you can override these options on each page individually.</span></p>         

                            </div>                   


                            <!-- Menu transparent checkbox -->
                            <div class="col-md-6 dimm-master hideifstle2" >
                                <?php $anps_options->anps_create_checkbox('anps_global_transparent_header', esc_html__('Transparent header', 'industrial'), '0' );?>
                            </div>

                              <!-- Menu centered checkbox -->
                            <div class="col-md-6">
                                <?php $anps_options->anps_create_checkbox('anps_global_menu_center', esc_html__('Menu centered', 'industrial'));?>
                            </div>  

                            <!-- Text color -->
                            <div class="col-md-4 dimm">
                                <?php $anps_options->anps_create_color_option('anps_global_text_color', '', esc_html__('Text color', 'industrial') );?>
                            </div>

                            <!-- Text hover color -->
                            <div class="col-md-4 dimm">
                                <?php $anps_options->anps_create_color_option('anps_global_text_hover_color', '', esc_html__('Text hover color', 'industrial') );?>
                            </div>

                           <!-- top bar color -->
                            <div class="col-md-4 onoff show-top dimm">
                                <?php $anps_options->anps_create_color_option('anps_global_topbar_color', '', esc_html__('Top bar color', 'industrial') );?>  
                            </div>

 

                        </div>

                    </div>    
                    <div class="col-md-12 show-vertical-layout onoff">

                        <h3><i class="fa fa-bars"></i> SET YOR <span>GLOBAL MENU VERTICAL</span> OPTION</h3>
                        <p>This options will apply globaly (including the home page), meaning over all pages. </p>

                          <!-- Text color -->
                            <div class="col-md-4">
                                <?php $anps_options->anps_create_color_option('anps_vertical_text_color', '', esc_html__('Text color', 'industrial') );?>
                            </div>

                            <!-- Background color -->
                            <div class="col-md-4">
                                <?php $anps_options->anps_create_color_option('anps_vertical_bg_color', '', esc_html__('Background color', 'industrial') );?>   
                            </div>

                            <!-- Text hover color -->
                            <div class="col-md-4">
                                <?php $anps_options->anps_create_color_option('anps_vertical_text_hover_color', '', esc_html__('Text hover color', 'industrial') );?>
                            </div>

                            <!-- Background upload -->
                            <div class="col-md-4 ">
                                <?php $anps_options->anps_create_upload('anps_vertical_menu_background', esc_html__('Background image', 'industrial'), false );?>
                            </div>                     
                    </div>
                </div>           
            </div>

            <div class="col-md-12">
                <h3><i class="fa fa-bars"></i><span>GLOBAL</span> header options</h3> 
                <div class="row">

                    <!--Top bar select-->                                                          
                    <div class="col-md-4">
                        <?php $top_bar_options = array('1'=>'Yes', '3'=>'No', '2'=>'Only on desktop');
                        $anps_options->anps_create_select('anps_global_topmenu_style', $top_bar_options,  'Display top bar');?>                   
                    </div>

                    <!-- Set above nav bar checkbox -->
                    <div class="col-md-4">
                        <?php $above_nav_options = array('1'=>'on', '2'=>'off');
                        $anps_options->anps_create_select('anps_global_above_nav_bar', $above_nav_options,  esc_html__('Display above menu bar', 'industrial') );?>                       
                    </div>   
                    
                    <!-- Sticky menu checkbox -->
                    <div class="col-md-4">
                       <?php $anps_options->anps_create_checkbox('anps_sticky_menu', esc_html__('Sticky menu', 'industrial'), '1');?>       
                    </div>

                    <!-- Display search mobile checkbox -->
                    <div class="col-md-4">
                       <?php $anps_options->anps_create_checkbox('anps_global_search_icon_mobile', esc_html__('Display search on mobile and tablets?', 'industrial'), '1');?>       
                    </div>
                    
                    <!-- Display search desktop checkbox -->
                    <div class="col-md-4">
                       <?php $anps_options->anps_create_checkbox('anps_global_search_icon', esc_html__('Display search icon in menu (desktop)?', 'industrial'), '1');?>            
                    </div>   
                    
                    <!-- Enable menu walker for our mega menu -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_checkbox('anps_global_menu_walker', esc_html__('Enable menu walker (mega menu)', 'industrial'), '1');?>
                    </div>
                    
                    <!-- Logo Background -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_checkbox('anps_logo_background', esc_html__('Display background color behind logo', 'industrial'), '1');?>
                    </div>
                </div>
            </div>                                 
            <div class="col-md-12">
                <h3><i class="fa fa-bars"></i> <?php esc_html_e('Heading Backgrounds', 'industrial'); ?></h3>
                <h4><?php esc_html_e('Select Your Heading Backgrounds', 'industrial'); ?></h4>
                <p><?php esc_html_e('The selected bacground will apply globaly over all pages. On each page you can upload its own background which will override the current
                setting in this panel for that page alone.', 'industrial'); ?></p><br><br>
            </div>
                 
            <!-- Page heading background upload -->
            <div class="col-md-4 ">
                <?php $anps_options->anps_create_upload('anps_page_heading_bg', esc_html__('Page heading background', 'industrial'), true );?>
            </div>            

            <!-- Search page content background upload -->
            <div class="col-md-4 ">
                <?php $anps_options->anps_create_upload('anps_search_content_bg', esc_html__('Search page content background', 'industrial'), true );?>
            </div>  
        </div>
    </div>    

    <!-- Save form -->
    <?php $anps_options->anps_save_button(); ?>
</form>