<?php

include 'includes/connectToDb.php';

global $conn;

// if the 'term' variable is not sent with the request, exit
if ( !isset($_REQUEST['term']) )
	exit;
 
// connect to the database server and select the appropriate database for use
//$dblink = mysql_connect('server', 'username', 'password') or die( mysql_error() );
//mysql_select_db('database_name');
 
// query the database table for zip codes that match 'term'
$rs = mysqli_query('SELECT email FROM  users WHERE user_email like "'. mysqli_real_escape_string($_REQUEST['term']) . '"', $conn);
 
// loop through each zipcode returned and format the response for jQuery
$data = array();
if ( $rs && mysqli_num_rows($rs) )
{
	while( $row = mysqli_fetch_array($rs, MYSQL_ASSOC) )
	{
		$data[] = array(
			'label' => $row['zip'] .', '. $row['city'] .' '. $row['state'] ,
			'value' => $row['zip']
		);
	}
}
 
// jQuery wants JSON data
echo json_encode($data);
flush();