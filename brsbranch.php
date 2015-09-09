<?php
/*
Plugin Name: Brazilian State Branch
Plugin URI: http://fabricio.inf.br
Description: List of brazilian states and the subdivisions of the company
Author: Fernando Fabricio dos Santos
Version: 0.0.1
Author URI: http://fabricio.inf.br
*/
require_once('brsb_install.php');

register_activation_hook(__FILE__, 'brsb_install' );
register_activation_hook(__FILE__, 'brsb_install_data' );

function brsbranch_get_states() {
    global $wpdb;

    $prefix = $wpdb->prefix;
    $states = $wpdb->get_results("SELECT * FROM ${prefix}brsb_state");
    $i = 0;
    $result = "<div class='brsb-states'>";
    foreach ($states as $state) {
        if ($i == 0) {
            $result .= "<ul>";
        }

        $result .= "<li><div class='brsb-uf'>".$state->uf."</div><div class='brsb-name'>".$state->name."</div></li>";
        $i++;
        if ($i == 9) {
            $result .= "</ul>";
            $i = 0;
        }
    }
    $result .= "</div><div class='brsb-clear'></div>";
    return $result;
}
