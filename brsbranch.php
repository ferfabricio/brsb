<?php
/*
Plugin Name: Units by Brazilian State
Plugin URI: http://fabricio.inf.br
Description: List of brazilian states and the subdivisions of the company
Author: Fernando Fabricio dos Santos
Version: 0.0.1
Author URI: http://fabricio.inf.br
*/
require_once('brsb_install.php');

//pn@W219xDLZ$FL%nDJ8Yrevm

register_activation_hook(__FILE__, 'brsb_install' );
register_activation_hook(__FILE__, 'brsb_install_data' );

add_action('wp_ajax_brsb_get_unit_by_uf',        'brsb_get_unit_by_uf');
add_action('wp_ajax_nopriv_brsb_get_unit_by_uf', 'brsb_get_unit_by_uf');


function brsbranch_get_states() {
    global $wpdb;

    wp_register_style('brsbStyle', plugins_url('stylebrsb.css', __FILE__));
    wp_enqueue_style('brsbStyle');

    $prefix = $wpdb->prefix;
    $states = $wpdb->get_results("SELECT * FROM ${prefix}brsb_state");
    $i = 0;
    $result = "<div class='brsb-states'>";
    foreach ($states as $state) {
        if ($i == 0) {
            $result .= "<ul>";
        }

        $result .= "<li><a href='#' onclick='showStateUnits(\"".$state->uf."\")'><div class='brsb-uf'>".$state->uf."</div><div class='brsb-name'>".$state->name."</div></a></li>";
        $i++;
        if ($i == 9) {
            $result .= "</ul>";
            $i = 0;
        }
    }
    $result .= "</div><div class='brsb-clear'></div>";
    $result .= "<div class='brsb-result'></div>";
    wp_register_script('brsbScript', plugins_url('brsb.js', __FILE__));
    wp_enqueue_script('brsbScript');

    wp_localize_script('brsbScript', 'ajax_object', array(
        'ajax_url'=>admin_url('admin-ajax.php')
    ));

    return $result;
}

function brsb_get_unit_by_uf() {
    global $wpdb;

    preg_match("/[A-Z]{2}/", $_POST['uf'], $uf);

    if(count($uf)!== 1) {
        header('Content-Type: application/json');
        echo json_encode(array('status'=>'NOK', 'data'=>'Unidade Inválida', 'uf'=> $uf));
        die();
    }

    $prefix = $wpdb->prefix;

    $sql = $wpdb->prepare("
        SELECT
            *
        FROM
            wp_brsb_state bs
            INNER JOIN wp_brsb_city bc
            ON bs.idbrsb_state = bc.idbrsb_state
        WHERE
            bs.uf = %s
    ", $uf[0]);

    $result = $wpdb->get_results($sql, ARRAY_A);

    if(count($result) > 0) {
        header('Content-Type: application/json');
        echo json_encode(array('status'=>'OK', 'data'=>$result, 'uf'=> $uf[0]));
        die();
    }

    header('Content-Type: application/json');
    echo json_encode(array('status'=>'NOK', 'data'=>'Nenhuma unidade encontrada', 'uf'=> $uf[0]));
    die();
}

function brsb_get_formated_html_unit($unit) {
    $return  = '<div class="brsb-unit-city-name">'. $unit->name . '</div>';
    $return .= '<div class="brsb-unit-description">' . $unit->description . '</div>';
    return $return;
}
