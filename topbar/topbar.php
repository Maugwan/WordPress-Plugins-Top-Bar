<?php
/**
* Plugin Name: Top Bar
* Description: yhis will add a walcome bar at to the top.
* Version: 1.0
* Author: Maugwan Lachatre
**/

//add bar after the opening body
add_action('wp_body_open', 'tb_head');

function get_user_or_websitename()
{
    if( !is_user_logged_in() ) {

        return 'to ' . get_bloginfo('name');
    }
    else
    {
        $current_user = xp_get_current_user();
        return $current_user -> user_login; 
    }
}

function tb_head()
{
    echo '<h3 class="tb">Welcome to ' . get_user_or_websitename() . '</h3>'; 
}

//add CSS to the top bar
add_action('wp_print_styles', 'tb_css');

function tb_css()
{
    echo '
        <style>
        h3.tb {color: #fff; margin: 0; padding: 30px; text-align: center; bacgroung: orange}
    
    ';
}

// Add Top Bar Plugin Page
function topbar_plugin_page()
{
    $page_title = 'Top Bar Options';
    $menu_title = 'Top Bar';
    $capatibility = 'manage_options';
     $slug = 'topbar-plugins';
     $callback = 'topbar_page_html';
     $icon = 'dashicons-schedule';
     $position = 60;

     add_menu_page($page_title, $menu_title, $capatibility, $slug, $callback, $icon, $position);
}

add_action('admin_menu', 'topbar_plugin_page');

 function topbar_register_settings() {
     register_setting('top_option_group', 'topbar_field'); 
 }

 add_action('admin_init', 'topbar_register_settings');

function topbar_page_html(){ ?>

     <div class="wrap top-bar-wrapper">
        <form method="post" action="options.php">
             <?php settings_errors(); ?>
             <?php settings_fields('topbar_option_group'); ?>
             <label for="topbar_field_eat">Top Bar Text:</label>
             <input name="topbar_field" id="topbar_field_eat" type="text" value=" <?php echo get_option('topbar_field')?> "> 
             <?php submit_button(); ?>
        </form>
    </div>

<?php }