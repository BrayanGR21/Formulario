<?php
session_name("siacel");
session_start();
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

$accion = $_POST["accion"];

switch ($accion) {
    case 'obtener-padron':
        // $table = '(select @i:=@i+1 AS consecutivo';
        $table = $_POST['table'];
        $ss_columns = json_decode($_POST['ssColumns']);
        $columns = array();
        $primaryKey = 'consecutivo';

        foreach ($ss_columns as $key => $value) {
            array_push($columns, array('db' => $value, 'dt' => $key, 'orderable' => false));
        }
        break;
}

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '4lt4m1r4*',
    'db'   => $_SESSION["usuario"]["bd"],
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);

