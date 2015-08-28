<?php

include 'connectToDb.php';


function getTrips ($user_id) {
	
	global $conn;
	
	$sql = "SELECT id,name,startDate,location FROM trips WHERE userId = '$user_id';";

	$userTrips = mysqli_query($conn, $sql);
	return $userTrips;

}

function getTripLocation ($trip_id) {

	global $conn;
	
	$sql = "SELECT location FROM trips WHERE id = '$trip_id';";

	$result = mysqli_query($conn, $sql);
	$tripLocation = mysqli_fetch_array( $result );
	echo $tripLocation['location'];
}
