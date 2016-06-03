<?php

/**
Fujitsu ServerView Dashboard test
Author : Ali Allomani <ali.allomani@gmail.com>
**/

require("./includes/db.php");


/**
ServerView Products Model Groups
**/
$qr = sqlsrv_query($sv_conn,"SELECT COUNT(*) AS count, R_Name FROM AM_CIM_ComputerSystemProduct GROUP BY R_Name");

 while( $row = sqlsrv_fetch_array( $qr, SQLSRV_FETCH_ASSOC) ) {
 if(strlen($row['R_Name']) > 3){
 $data_model[] = array("y"=>$row['count'],"legendText"=>$row['R_Name'],"label"=>$row['R_Name']);
 }
}

$pie_options  = array(
"title"=>array("text"=>"SV : Products By Model"),
"animationEnabled"=>true,
"legend"=>array("verticalAlign"=>"bottom","horizontalAlign"=>"center","fontSize"=>12,"fontFamily"=>"Helvetica"),
"theme"=>"theme1",
"data"=>array(array(
"type"=> "doughnut",       
"indexLabelFontFamily" => "Garamond",       
"indexLabelFontSize" => 13,
"indexLabel"=>"{label} ({y}) {y}%",
			"startAngle"=>"-20",      
			"showInLegend"=>true,
			"toolTipContent"=>"{label} ({y}) {y}%",
			"dataPoints"=>$data_model
))
) ;


?>
<!DOCTYPE HTML>
<html>
<head>  
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",<?=json_encode($pie_options);?>);
	chart.render();
}
</script>
<script type="text/javascript" src="js/canvasjs.min.js"></script> 
<title> Fujitsu ServerView Dashboard</title>
</head>
<body>
<img src="images/logo.gif" />
<div id="chartContainer" style="height: 400px; width: 100%;"></div>
</body>

<?







 
//	 print_r(sqlsrv_server_info($sv_conn));
	 

print "<h1>Group List</h1>";
$stmt = sqlsrv_query( $sv_conn, "select * from dbo.GROUP_LIST");

print "<table>";
	 while( $data = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	 print "<tr>";
  foreach($data as $name=>$row){
  print "<td>$name : ".$row."</td>";
  }
  print "</tr>";
}
print "</table>";



print "<h1>VIOM Profiles </h2>";
$qr = sqlsrv_query( $viom_conn, "select * from dbo.V_SERVER_PROFILE");
print "<pre>";
	 while( $row = sqlsrv_fetch_array( $qr, SQLSRV_FETCH_ASSOC) ) {
   print_r($row);
}
print "</pre>";


