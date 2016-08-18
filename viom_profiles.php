<?php
/**
Fujitsu ServerView Dashboard test
Author : Ali Allomani <ali.allomani@gmail.com>
**/

require("./includes/db.php");
require("./includes/header.php");


print "<h1>VIOM Profiles </h2>";
$qr = sqlsrv_query( $viom_conn, "select * from dbo.V_SERVER_PROFILE");
print "<pre>";
	 while( $row = sqlsrv_fetch_array( $qr, SQLSRV_FETCH_ASSOC) ) {
   print_r($row);
}
print "</pre>";
