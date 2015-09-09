<?php

function brsb_install()
{
    global $wpdb;

    require_once ABSPATH.'wp-admin/includes/upgrade.php';

    $charset_collate = $wpdb->get_charset_collate();
    $prefix = $wpdb->prefix;

    $sql_state = "CREATE TABLE IF NOT EXISTS `${prefix}brsb_state` (
            `idbrsb_state` INT NOT NULL AUTO_INCREMENT,
            `uf` CHAR(2) NOT NULL,
            `name` VARCHAR(50) NOT NULL,
            PRIMARY KEY (`idbrsb_state`),
            INDEX `uf_INDEX` (`uf` ASC),
            UNIQUE INDEX `uf_UNIQUE` (`uf` ASC))
            ${charset_collate};
    ";

    dbDelta($sql_state);

    $sql_unit = "CREATE TABLE IF NOT EXISTS `${prefix}brsb_unit` (
            `idbrsb_unit` INT NOT NULL AUTO_INCREMENT,
            `idbrsb_state` INT NULL,
            `name` VARCHAR(80) NULL,
            `url` VARCHAR(100) NULL,
            `address` VARCHAR(150) NULL,
            `phone` VARCHAR(150) NULL,
            `description` VARCHAR(255) NULL,
            PRIMARY KEY (`idbrsb_unit`),
            INDEX `fk_brsb_unit_state_idx` (`idbrsb_state` ASC),
            CONSTRAINT `fk_brsb_unit_state`
            FOREIGN KEY (`idbrsb_state`)
            REFERENCES `${prefix}brsb_state` (`idbrsb_state`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION)
            ${charset_collate};";

    dbDelta($sql_unit);
}

function brsb_install_data()
{
    global $wpdb;

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'AC',
            'name' => 'Acre',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'AL',
            'name' => 'Alagoas',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'AM',
            'name' => 'Amazonas',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'AP',
            'name' => 'Amapá',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'BA',
            'name' => 'Bahia',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'CE',
            'name' => 'Ceará',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'DF',
            'name' => 'Distrito Federal',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'ES',
            'name' => 'Espírito Santo',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'GO',
            'name' => 'Goiás',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'MA',
            'name' => 'Maranhão',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'MG',
            'name' => 'Minas Gerais',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'MS',
            'name' => 'Mato Grosso do Sul',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'MT',
            'name' => 'Mato Grosso',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'PA',
            'name' => 'Pará',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'PB',
            'name' => 'Paraíba',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'PE',
            'name' => 'Pernambuco',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'PI',
            'name' => 'Piauí',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'PR',
            'name' => 'Paraná',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'RJ',
            'name' => 'Rio de Janeiro',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'RN',
            'name' => 'Rio Grande do Norte',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'RR',
            'name' => 'Roraima',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'RO',
            'name' => 'Rondônia',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'RS',
            'name' => 'Rio Grande do Sul',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'SC',
            'name' => 'Santa Catarina',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'SE',
            'name' => 'Sergipe',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'SP',
            'name' => 'São Paulo',
        )
    );

    $wpdb->insert(
        $wpdb->prefix.'brsb_state',
        array(
            'uf' => 'TO',
            'name' => 'Tocantins',
        )
    );
}
