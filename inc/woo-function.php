<?php

    if (in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option('active_plugins')))) {

    	function mytheme_add_woocommerce_support() {
    	    add_theme_support( 'woocommerce' );
    	}

    	add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );




    	add_action('woocommerce_before_shop_loop','sort_view_start', 29);
    	add_action('woocommerce_before_shop_loop','sort_view_end', 40);

    	function sort_view_start() { ?>

    		<div class="wrapper-top-ordering d-flex">
    	<?php }

    	function sort_view_end() { ?>
                <div class="wrapper-top-btns">
                    <?php echo do_shortcode('[br_grid_list]') ?>
                </div>

    		</div>
    	<?php }



        add_action('woocommerce_before_shop_loop','top_wrapper_start', 15);
        add_action('woocommerce_before_shop_loop','top_wrapper_end', 45);

        function top_wrapper_start() { ?>
    		<div class="wrapper-top d-flex">
    	<?php }

    	function top_wrapper_end() { ?>
    		</div>
    	<?php }

    }

 ?>
