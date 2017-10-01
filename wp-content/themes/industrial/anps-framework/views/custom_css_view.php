<?php 
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');

if (isset($_GET['save_css'])) {
    update_option("anps_custom_css", stripcslashes($_POST['anps_custom_css']));
    header("Location: themes.php?page=theme_options&sub_page=theme_style_custom_css");
}
?>
<form action="themes.php?page=theme_options&sub_page=theme_style_custom_css&save_css" method="post">
    <div class="content-inner">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-code"></i><?php esc_html_e('Custom css', 'industrial'); ?></h3>    
                <div class="input fullwidth" id="anps_custom_css_wrapper">
                    <label for="anps_custom_css"><?php esc_html_e('Custom css', 'industrial'); ?></label>
                    <textarea name="anps_custom_css" id="anps_custom_css" class="fullwidth"><?php echo get_option('anps_custom_css', ''); ?> </textarea>    
                </div>

                <!-- Editor -->
                <div class="input fullwidth">
                    <div class="anps-editor-wrapper">
                        <div class="anps-editor" id="editor"><?php echo get_option('anps_custom_css', ''); ?></div>
                    </div>
                </div> 
            </div>            
        </div>
    </div>

    <!-- Save form -->
    <?php $anps_style->anps_save_button(); ?>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/ace.min.js" type="text/javascript"></script>
<script>
    ace.config.set("basePath", "<?php echo get_template_directory_uri(); ?>/anps-framework/js");
    var editor = ace.edit("editor");
    editor.getSession().setMode("ace/mode/css");

    jQuery('#anps_custom_css_wrapper').hide()

    var textarea = jQuery('#anps_custom_css');
    editor.getSession().on('change', function(){
        textarea.val(editor.getSession().getValue());
    });
</script>