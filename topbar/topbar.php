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