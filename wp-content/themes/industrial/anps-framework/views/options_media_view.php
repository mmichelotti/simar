<?php
//Check classes/AnpsFramework.php for available field options and settings.
include_once(get_template_directory() . '/anps-framework/classes/AnpsOptions.php');
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');
if (isset($_GET['save_media'])) {
    $anps_options->anps_save_options("options_media"); 
}

wp_enqueue_script("my-upload");
wp_enqueue_style("thickbox");
?>

<form action="themes.php?page=theme_options&sub_page=options_media&save_media" method="post">
    <div class="content-inner">

        <div class="row">

            <div class="col-md-12">
                <h3><i class="fa fa-picture-o"></i><?php esc_html_e('Favicon and logo:', 'industrial'); ?></h3>           
                <p><?php esc_html_e('If you would like to use your logo and favicon, upload them to your theme here.', 'industrial'); ?></p>
            </div>

            <!-- Logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_logo', esc_html__('Logo', 'industrial')); ?>
            </div>

            <!-- Logo height -->
            <div class="col-md-6">    
                <?php $anps_style->anps_create_number_option('anps_logo_height', '', esc_html__('Logo height', 'industrial'), 'px'); ?>
            </div>            

        </div>    
        <div class="row">
            <!-- Front page logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_front_logo', esc_html__('Front page logo', 'industrial')); ?>
            </div>    

            <!-- Front page logo height -->
            <div class="col-md-6">    
                <?php $anps_style->anps_create_number_option('anps_front_logo_height', '', esc_html__('Front page logo height', 'industrial'), 'px'); ?>
            </div>
        </div>

        <div class="row">
            <!-- Sticky logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_sticky_logo', esc_html__('Sticky logo', 'industrial')); ?>
            </div>

            <!-- Sticky logo height -->
            <div class="col-md-6">  
                <?php $anps_style->anps_create_number_option('anps_sticky_logo_height', '', esc_html__('Sticky logo height', 'industrial'), 'px'); ?>
            </div>
        </div>    

        <div class="row">

            <div class="clearfix"></div>
            <!-- Sticky transparent Logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_sticky_transparent_logo', esc_html__('Transparent Sticky logo', 'industrial')); ?>
            </div>

            <!-- Logo height -->
            <div class="col-md-6">    
                <?php $anps_style->anps_create_number_option('anps_sticky_transparent_logo_height', '', esc_html__('Transparent Sticky logo height', 'industrial'), 'px'); ?>
            </div>
        </div>
        
        <div class="row">
            <!-- Mobile logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_mobile_logo', esc_html__('Mobile logo', 'industrial')); ?>
            </div>

            <!-- Favicon -->           
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_favicon', esc_html__('Favicon', 'industrial')); ?>
            </div>        
        </div>        

    </div>

    <!-- Save form -->
    <?php $anps_options->anps_save_button(); ?>
</form>