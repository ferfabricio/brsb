<?php

/*
Plugin Name: Units by Brazilian States
Plugin URI: http://fabricio.inf.br
Description: List of brazilian states and the subdivisions of the company
Author: Fernando Fabricio dos Santos
Version: 0.0.1
Author URI: http://fabricio.inf.br
*/
$path = plugin_dir_path(__FILE__);

require_once $path . 'brsb-install.php';
require_once $path . 'ajax.php';
require_once $path . 'admin.php';

//pn@W219xDLZ$FL%nDJ8Yrevm

register_activation_hook(__FILE__, 'brsb_install');
register_activation_hook(__FILE__, 'brsb_install_data');

//add_menu_page('Units by Brazilian States', 'Units', 'manage_options', 'brsb-options', 'brsb_admin');

function brsbranch_get_states()
{
    global $wpdb;

    wp_register_style('brsbStyle', plugins_url('css/stylebrsb.css', __FILE__));
    wp_enqueue_style('brsbStyle');

    $prefix = $wpdb->prefix;
    $states = $wpdb->get_results("SELECT * FROM ${prefix}brsb_state");
    $result = brsbranch_prepare_states_html($states);

    wp_register_script('brsbScript', plugins_url('js/brsb.js', __FILE__));
    wp_enqueue_script('brsbScript');

    wp_localize_script('brsbScript', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));

    return $result;
}

function brsbranch_prepare_states_html($states)
{
    $i = 0;
    $result = "<div class='brsb-states'>";
    foreach ($states as $state) {
        if ($i == 0) {
            $result .= '<ul>';
        }

        $result .= "<li><a href='#' onclick='showStateUnits(\"".$state->uf."\")'><div class='brsb-uf'>".$state->uf."</div><div class='brsb-name'>".$state->name.'</div></a></li>';
        ++$i;
        if ($i == 9) {
            $result .= '</ul>';
            $i = 0;
        }
    }
    $result .= "</div><div class='brsb-clear'></div>";
    $result .= "<div class='brsb-result'></div>";

    return $result;
}
