<?php if(!is_search()): ?>
</div><!-- end .row -->
</div><!-- end .container -->
</main><!-- end .site-main -->
<?php endif; ?>
<?php
//check for blank page
$footer_value = '';
if($post) {
    $footer_value = get_post_meta($post->ID, $key ='anps_blank_page_disable_footer', $single = true );
}
if(!isset($footer_value) || $footer_value!='on') {
    get_sidebar( 'footer' ); 
}
?>
</div> <!-- .site -->
<?php wp_footer(); ?>
</body>
</html>