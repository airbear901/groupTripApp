<?php

include 'connectToDb.php';


function getTrips ($user_id) {
	
	global $conn;
	
	$sql = "SELECT name,startDate,location FROM trips WHERE userId = '$user_id';";

	$userTrips = mysqli_query($conn, $sql);
	return $userTrips;

}
