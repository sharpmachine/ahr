<?php
/*
Plugin Name: Display widgets
Plugin URI: http://strategy11.com/display-widgets/
Description: Adds checkboxes to each widget to show or hide on site pages.
Author: Stephanie Wells
Author URI: http://strategy11.com
Version: 1.20
*/

load_plugin_textdomain( 'display-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

add_filter('widget_display_callback', 'show_dw_widget');
add_action('in_widget_form', 'dw_show_hide_widget_options', 10, 3);
add_filter('widget_update_callback', 'dw_update_widget_options', 10, 3);

function show_dw_widget($instance){
    global $wp_query;
    $post_id = $wp_query->get_queried_object_id();
    
    if (is_home()){
        $show = isset($instance['page-home']) ? ($instance['page-home']) : false;
    }else if (is_front_page()){
        $show = isset($instance['page-front']) ? ($instance['page-front']) : false;
    }else if (is_category()){
        $show = isset($instance['cat-'.get_query_var('cat')]) ? ($instance['cat-'.get_query_var('cat')]) : false;
    }else if(is_tax()){
        $term = get_queried_object();
        $show = isset($instance['tax-'.$term->taxonomy]) ? ($instance['tax-'.$term->taxonomy]) : false;
        unset($term);
    }else if (is_archive()){
        $show = isset($instance['page-archive']) ? ($instance['page-archive']) : false;
    }else if (is_single()){
        if(function_exists('get_post_type')){
            $type = get_post_type();
            if($type != 'page' and $type != 'post')
                $show = isset($instance['type-'.$type]) ? ($instance['type-'.$type]) : false;
        }
        
        if(!isset($show))
            $show = isset($instance['page-single']) ? ($instance['page-single']) : false;
            
        if (!$show){
            $cats = get_the_category();
            foreach($cats as $cat){ 
                if ($show) continue;
                if (isset($instance['cat-'.$cat->cat_ID]))
                    $show = $instance['cat-'.$cat->cat_ID];
            } 
        }
    }else if (is_404()){ 
        $show = isset($instance['page-404']) ? ($instance['page-404']) : false;
    }else if (is_search()){
        $show = isset($instance['page-search']) ? ($instance['page-search']) : false;
    }else if($post_id){
        $show = isset($instance['page-'.$post_id]) ? ($instance['page-'.$post_id]) : false;
    }
        
    if ($post_id and !$show and isset($instance['other_ids']) and !empty($instance['other_ids'])){
        $other_ids = explode(',', $instance['other_ids']);
        foreach($other_ids as $other_id){
            if($post_id == (int)$other_id)
                $show = true;
        }
    }

    if(!isset($show))
        $show = false;
    
    if (isset($instance['include']) && (($instance['include'] and $show == false) or ($instance['include'] == 0 and $show))){
        return false;
    }else{
        global $user_ID;
        if( (isset($instance['logout']) and $instance['logout'] and $user_ID) or 
            (isset($instance['login']) and $instance['login'] and !$user_ID)) 
            return false;
            
    }
	return $instance;
}

function dw_show_hide_widget_options($widget, $return, $instance){
    dw_register_globals();
    
    global $dw_pages, $dw_cats, $dw_taxes, $dw_cposts, $dw_checked, $dw_loaded;

    $wp_page_types = array(
        'front' => __('Front', 'display-widgets'), 
        'home' => __('Blog', 'display-widgets'),
        'archive' => __('Archives', 'display-widgets'),
        'single' => __('Single Post', 'display-widgets'),
        '404' => '404', 'search' => __('Search', 'display-widgets')
    );
            
    $instance['include'] = isset($instance['include']) ? $instance['include'] : 0;
    $instance['logout'] = isset($instance['logout']) ? $instance['logout'] : 0;
    $instance['login'] = isset($instance['login']) ? $instance['login'] : 0;
    $instance['other_ids'] = isset($instance['other_ids']) ? $instance['other_ids'] : '';
?>   
     <p>
    	<label for="<?php echo $widget->get_field_id('include'); ?>"><?php _e('Show/Hide Widget', 'display-widgets') ?></label>
    	<select name="<?php echo $widget->get_field_name('include'); ?>" id="<?php echo $widget->get_field_id('include'); ?>" class="widefat">
            <option value="0" <?php echo selected( $instance['include'], 0 ) ?>><?php _e('Hide on checked', 'display-widgets') ?></option> 
            <option value="1" <?php echo selected( $instance['include'], 1 ) ?>><?php _e('Show on checked', 'display-widgets') ?></option>
        </select>
    </p>    

<div style="height:150px; overflow:auto; border:1px solid #dfdfdf;">
    <p><input class="checkbox" type="checkbox" <?php checked($instance['logout'], true) ?> id="<?php echo $widget->get_field_id('logout'); ?>" name="<?php echo $widget->get_field_name('logout'); ?>" value="1" />
    <label for="<?php echo $widget->get_field_id('logout'); ?>"><?php _e('Show only for Logged-out users', 'display-widgets') ?></label></p>
    <p><input class="checkbox" type="checkbox" <?php checked($instance['login'], true) ?> id="<?php echo $widget->get_field_id('login'); ?>" name="<?php echo $widget->get_field_name('login'); ?>" value="1" />
    <label for="<?php echo $widget->get_field_id('login'); ?>"><?php _e('Show only for Logged-in users', 'display-widgets') ?></label></p>
    
    <h4 onclick="dw_toggle(jQuery(this))" style="cursor:pointer;"><?php _e('Miscellaneous', 'display-widgets') ?> +/-</h4>
    <div class="dw_collapse">
    <?php foreach ($wp_page_types as $key => $label){ 
        $instance['page-'. $key] = isset($instance['page-'. $key]) ? $instance['page-'. $key] : false;
    ?>
        <p><input class="checkbox" type="checkbox" <?php checked($instance['page-'. $key], true) ?> id="<?php echo $widget->get_field_id('page-'. $key); ?>" name="<?php echo $widget->get_field_name('page-'. $key); ?>" />
        <label for="<?php echo $widget->get_field_id('page-'. $key); ?>"><?php echo $label .' '. __('Page', 'display-widgets') ?></label></p>
    <?php } ?>
    </div>
    
    <h4 onclick="dw_toggle(jQuery(this))" style="cursor:pointer;"><?php _e('Pages', 'display-widgets') ?> +/-</h4>
    <div class="dw_collapse">
    <?php foreach ($dw_pages as $page){ 
        $instance['page-'.$page->ID] = isset($instance['page-'.$page->ID]) ? $instance['page-'.$page->ID] : false;   
    ?>
        <p><input class="checkbox" type="checkbox" <?php checked($instance['page-'.$page->ID], true) ?> id="<?php echo $widget->get_field_id('page-'.$page->ID); ?>" name="<?php echo $widget->get_field_name('page-'.$page->ID); ?>" />
        <label for="<?php echo $widget->get_field_id('page-'.$page->ID); ?>"><?php echo $page->post_title ?></label></p>
    <?php	}  ?>
    </div>
    
    <?php if(isset($dw_cposts) and !empty($dw_cposts)){ ?>
    <h4 onclick="dw_toggle(jQuery(this))" style="cursor:pointer;"><?php _e('Custom Post Types', 'display-widgets') ?> +/-</h4>
    <div class="dw_collapse">
    <?php foreach ($dw_cposts as $post_key => $custom_post){ 
        $instance['type-'. $post_key] = isset($instance['type-'. $post_key]) ? $instance['type-'. $post_key] : false;
    ?>
        <p><input class="checkbox" type="checkbox" <?php checked($instance['type-'. $post_key], true) ?> id="<?php echo $widget->get_field_id('type-'. $post_key); ?>" name="<?php echo $widget->get_field_name('type-'. $post_key); ?>" />
        <label for="<?php echo $widget->get_field_id('type-'. $post_key); ?>"><?php echo stripslashes($custom_post->labels->name) ?></label></p>
    <?php } ?>
    </div>
    <?php } ?>
    
    <h4 onclick="dw_toggle(jQuery(this))" style="cursor:pointer;"><?php _e('Categories', 'display-widgets') ?> +/-</h4>
    <div class="dw_collapse">
    <?php foreach ($dw_cats as $cat){ 
        $instance['cat-'.$cat->cat_ID] = isset($instance['cat-'.$cat->cat_ID]) ? $instance['cat-'.$cat->cat_ID] : false;   
    ?>
        <p><input class="checkbox" type="checkbox" <?php checked($instance['cat-'.$cat->cat_ID], true) ?> id="<?php echo $widget->get_field_id('cat-'.$cat->cat_ID); ?>" name="<?php echo $widget->get_field_name('cat-'.$cat->cat_ID); ?>" />
        <label for="<?php echo $widget->get_field_id('cat-'.$cat->cat_ID); ?>"><?php echo $cat->cat_name ?></label></p>
    <?php
        unset($cat);
        } 
    ?>
    </div>
    
    <?php if(isset($dw_taxes) and !empty($dw_taxes)){ ?>
    <h4 onclick="dw_toggle(jQuery(this))" style="cursor:pointer;"><?php _e('Taxonomies', 'display-widgets') ?> +/-</h4>
    <div class="dw_collapse">
    <?php foreach ($dw_taxes as $tax){ 
        $instance['tax-'.$tax] = isset($instance['tax-'.$tax]) ? $instance['tax-'.$tax] : false;   
    ?>
        <p><input class="checkbox" type="checkbox" <?php checked($instance['tax-'.$tax], true) ?> id="<?php echo $widget->get_field_id('tax-'.$tax); ?>" name="<?php echo $widget->get_field_name('tax-'.$tax); ?>" />
        <label for="<?php echo $widget->get_field_id('tax-'.$tax); ?>"><?php echo str_replace(array('_','-'), ' ', ucfirst($tax)) ?></label></p>
    <?php
        unset($tax);
        } 
    ?>
    </div>
    <?php } ?>
    
    <p><label for="<?php echo $widget->get_field_id('other_ids'); ?>"><?php _e('Comma Separated list of IDs of posts not listed above', 'display-widgets') ?>:</label>
    <input type="text" value="<?php echo $instance['other_ids'] ?>" name="<?php echo $widget->get_field_name('other_ids'); ?>" id="<?php echo $widget->get_field_id('other_ids'); ?>" />
    </p>
    </div>
<?php if(!$dw_loaded){ ?>
<script type="text/javascript">function dw_toggle($this){$this.next('.dw_collapse').toggle();}</script>
<?php
        $dw_loaded = true;
    }
}

function dw_update_widget_options($instance, $new_instance, $old_instance){
    dw_register_globals();
    
    global $dw_pages, $dw_cats, $dw_taxes, $dw_cposts, $dw_checked;
    
    if($dw_pages){
        foreach ($dw_pages as $page){
            $instance['page-'.$page->ID] = isset($new_instance['page-'.$page->ID]) ? 1 : 0;
            unset($page);
        }
    }
    
    foreach ($dw_cats as $cat){
        $instance['cat-'.$cat->cat_ID] = isset($new_instance['cat-'.$cat->cat_ID]) ? 1 : 0;
        unset($cat);
    }
    
    if($dw_cposts){
        foreach ($dw_cposts as $post_key => $custom_post){
            $instance['type-'.$post_key] = isset($new_instance['type-'.$post_key]) ? 1 : 0;
            unset($custom_post);
        }
    }
    
    if($dw_taxes){
        foreach ($dw_taxes as $tax){
            $instance['tax-'.$tax] = isset($new_instance['tax-'.$tax]) ? 1 : 0;
            unset($tax);
        }
    }
           
    $instance['include'] = $new_instance['include'] ? 1 : 0;
    $instance['logout'] = $new_instance['logout'] ? 1 : 0;
    $instance['login'] = $new_instance['login'] ? 1 : 0;
    $instance['other_ids'] = $new_instance['other_ids'] ? $new_instance['other_ids'] : '';
    
    foreach(array('front', 'home', 'archive', 'single', '404', 'search') as $page)
        $instance['page-'. $page] = isset($new_instance['page-'. $page]) ? 1 : 0;

    return $instance;
}

function dw_register_globals(){
    global $dw_pages, $dw_cats, $dw_taxes, $dw_cposts, $dw_checked;
    
    if(!$dw_checked){
        if(!$dw_pages)
            $dw_pages = get_posts( array(
                'post_type' => 'page', 'post_status' => 'publish', 
                'numberposts' => 999, 'orderby' => 'title', 'order' => 'ASC'
            ));
        
        if(!$dw_cats)
            $dw_cats = get_categories(array('hide_empty' => false));    
            
        if(!$dw_cposts and function_exists('get_post_types')){
            $dw_cposts = get_post_types(array(), 'object');
            foreach(array('revision','post','page','attachment','nav_menu_item') as $unset)
                unset($dw_cposts[$unset]);
                
            foreach($dw_cposts as $c => $type){
                $post_taxes = get_object_taxonomies($c);
                foreach($post_taxes as $tax => $post_tax)
                    $dw_taxes[$tax] = $post_tax;
            }
        }
        
        $dw_checked = true;
    }

}


//TODO: Add text field that accepts full urls that will be checked under 'else'
