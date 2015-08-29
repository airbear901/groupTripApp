<?php


//require 'conf.inc.php';
/* prevent direct access to this page */
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
  $user_error = 'Access denied - direct call is not allowed...';
  trigger_error($user_error, E_USER_ERROR);
}
ini_set('display_errors',1);
 
/* if the 'term' variable is not sent with the request, exit */
if ( !isset($_REQUEST['term']) ) {
	
	exit;
}
 
//$mysqli = new MySQLi($server,$user,$password,$database);

//include 'includes/connectToDb.php';
//global $connObj;

$connObj = new MySQLi($servername,$username,$password,$dbname,$port);
echo $connObj;

/* Connect to database and set charset to UTF-8 */
if($connObj->connect_error) {
  echo 'Database connection failed...' . 'Error: ' . $connObj->connect_errno . ' ' . $connObj->connect_error;
  exit;
} else {
  $connObj->set_charset('utf8');
}
 
/* retrieve the search term that autocomplete sends */
$term = trim(strip_tags($_GET['term'])); 
/* replace multiple spaces with one */
$term = preg_replace('/\s+/', ' ', $term);

echo $term;
 
$a_json = array();
$a_json_row = array();
 
$a_json_invalid = array(array("id" => "#", "value" => $term, "label" => "Only letters and digits are permitted..."));
$json_invalid = json_encode($a_json_invalid);
 
/* SECURITY HOLE *************************************************************** */
/* allow space, any unicode letter and digit, underscore and dash                */
if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
  print $json_invalid;
  exit;
}
/* ***************************************************************************** */
 
if ($data = $mysqli->query("SELECT * FROM users WHERE user_email LIKE '%$term%'")) {
	while($row = mysqli_fetch_array($data)) {
		$user_email = htmlentities(stripslashes($row['user_email']));
		//$lastname = htmlentities(stripslashes($row['lastname']));
		$userId= htmlentities(stripslashes($row['user_id']));
		$a_json_row["id"] = $userId;
		$a_json_row["value"] = $user_email;
		$a_json_row["label"] = $user_email;
		array_push($a_json, $a_json_row);
	}
}
 
/* jQuery wants JSON data */
echo json_encode($a_json);
flush();
 
$mysqli->close();