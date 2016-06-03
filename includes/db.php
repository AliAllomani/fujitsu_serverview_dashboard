<?php

$svdb_serverName = "JEDMGMT07\SQLSERVERVIEW";
$svdb_connectionInfo = array( 
"UID"=>"readonly",
"PWD"=>"readonly",
"Database"=>"ServerViewDB"
);

$viomdb_serverName = "JEDMGMT07\SQLSERVERVIEW";
$viomdb_connectionInfo = array( 
"UID"=>"readonly",
"PWD"=>"readonly",
"Database"=>"viomDB"
);


$sv_conn = sqlsrv_connect( $svdb_serverName, $svdb_connectionInfo);

if( !$sv_conn )
{
 die( print_r( sqlsrv_errors(), true));
   
}


$viom_conn = sqlsrv_connect( $viomdb_serverName, $viomdb_connectionInfo);

if( !$viom_conn )
{
 die( print_r( sqlsrv_errors(), true));
   
}

?>