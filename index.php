<?php

/**
Fujitsu ServerView Dashboard test
Author : Ali Allomani <ali.allomani@gmail.com>
**/

require("./includes/db.php");
require("./includes/header.php");

/**
ServerView Products Model Groups
**/
$qr = sqlsrv_query($sv_conn,"SELECT COUNT(*) AS count, SystemType FROM SERVER_LIST where SystemType not like '%VIRTUAL MACHINE' GROUP BY SystemType");

 while( $row = sqlsrv_fetch_array( $qr, SQLSRV_FETCH_ASSOC) ) {
 if(strlen($row['SystemType']) > 3){
 $data_model[] = array("y"=>$row['count'],"legendText"=>$row['SystemType'],"label"=>$row['SystemType']);
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
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",<?=json_encode($pie_options);?>);
	chart.render();
}
</script>
<div id="chartContainer" style="height: 400px; width: 100%;margin:10px;"></div>
<?


$qr = sqlsrv_query($sv_conn,"SELECT * FROM SERVER_LIST where SystemType not like '%VIRTUAL MACHINE'");
print "<table class=\"display\" cellspacing=\"0\" width=\"100%\" id=\"serverslist_table\">
<thead>
           <tr>
           <th width=300>Server Name</th>
           <th>Type</th>
           <th>IP Address</th>
            <th>System Type</th>
            <th>Serial Number</th>
           </tr>
</thead>
 <tbody>
 ";
 while( $row = sqlsrv_fetch_array( $qr, SQLSRV_FETCH_ASSOC) ) {
print "
<tr>
<td>".str_replace("\\","-",$row['DisplayName']).($row['SystemName'] ? " ({$row['SystemName']})" :  "")."</td>
<td>{$row['Type']}</td>
<td>{$row['NetAddress']}</td>
<td>{$row['SystemType']}</td>
<td>{$row['Identnum']}</td>
</tr>";
}
print "
</tbody>
<tfoot></tfoot>
</table>";
?>
<script>
$(document).ready(function(){
  var  oTable =  $('#serverslist_table').DataTable({
      "paging":   false,
        "bJQueryUI": true,
  //      "scrollX": true,
  //      scrollY:        '50vh',
  //     scrollCollapse: true,

});
   yadcf.init(oTable, [{
					        column_number: 0,
                  filter_type: "multi_select",
          select_type: 'select2',
    }, {
					        column_number: 1,
			            filter_type: "multi_select",
                    select_type: 'select2',
					    }, {
					        column_number: 2,
					        filter_type: "multi_select",
                  select_type: 'select2',
					    }, {
					        column_number: 3,
					          filter_type: "text",
					    }, {
					        column_number: 4,
					          filter_type: "text",
					    }
            ],{
            cumulative_filtering: false
        });

});
</script>
<?

//	 print_r(sqlsrv_server_info($sv_conn));

/*
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

*/
