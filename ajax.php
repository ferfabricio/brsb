<?php
add_action('wp_ajax_brsb_get_unit_by_uf',        'brsb_get_unit_by_uf');
add_action('wp_ajax_nopriv_brsb_get_unit_by_uf', 'brsb_get_unit_by_uf');

function brsb_get_unit_by_uf()
{
    preg_match('/[A-Z]{2}/', $_POST['uf'], $uf);

    if (count($uf) == 1) {
        $result = brsb_get_units_by_uf($uf[0]);

        if (count($result) > 0) {
			$unit = array(
				'name' => $result[0]['name'],
				'address' => $result[0]['address'],
				'description' => $result[0]['description'],
				'phone' => $result[0]['phone'],
				'url' => $result[0]['url']
			);

            $data = array('status' => 'OK', 'data' => $unit, 'uf' => $uf[0]);
        } else {
            $data = array(
                'status' => 'NOK',
                'data' => 'Nenhuma unidade encontrada',
                'uf' => $uf[0],
            );
        }
    } else {
        $data = array('status' => 'NOK', 'data' => 'Unidade Inválida', 'uf' => $uf);
    }

    brsb_display_json($data);
}

function brsb_get_units_by_uf($uf)
{
	global $wpdb;

    $prefix = $wpdb->prefix;

    $sql = $wpdb->prepare('
        SELECT
            *
        FROM
            wp_brsb_state bs
            INNER JOIN wp_brsb_unit bu
            ON bs.idbrsb_state = bu.idbrsb_state
        WHERE
            bs.uf = %s
    ', $uf);

    return $wpdb->get_results($sql, ARRAY_A);
}

function brsb_display_json($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
    die();
}
