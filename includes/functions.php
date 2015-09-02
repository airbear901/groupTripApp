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

	$tripLocation = mysqli_query($conn, $sql);
	$tripLocation = mysqli_fetch_array( $result );
	return  $tripLocation['location'];
}

function latLong ($tripLocation) {
	$maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($tripLocation);

	$maps_json = file_get_contents($maps_url);
	$maps_array = json_decode($maps_json, true);

	$lng = $maps_array['results'][0]['geometry']['location']['lng'];
	$lat = $maps_array['results'][0]['geometry']['location']['lat'];
	
	return $lng;
	return $lat;
}

function getUserId ($user_email) {
	
	global $conn;
	$sql = "SELECT user_id FROM users WHERE user_email LIKE '$user_email';";
	$result = mysqli_query($conn, $sql);
	$partId = mysqli_fetch_array( $result );
	return  $partId['user_id'];

}

function insertParticipant ($trip_id, $user_id){

	global $conn;

	$sql = "INSERT INTO participants (trip_id, user_id) VALUES ('$trip_id', '$user_id')";

	if (mysqli_query($conn, $sql)) {
			mysqli_close($conn);
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
}


