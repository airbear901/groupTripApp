<html>
<head>
	<?php 
		include 'includes/connectToDb.php'; 
		include 'includes/functions.php';
	?>
</head>
<body>

<?php

if (isset($_GET["trip_id"])) { //Old trip
	
	$trip_id = $_GET["trip_id"];
	
	$tripLocation = getTripLocation($trip_id);

} elseif (isset($_POST["tripName"])) { //New trip
	
	// make it a variable
	$tripName = $_POST["tripName"];
	$tripStartDate = $_POST["from"];
	$tripEndDate = $_POST["to"];
	$tripDescription = $_POST["tripDescription"];
	$tripLocation = $_POST["tripLocation"];
	$tripUserId = $_POST["user_id"];	
	$partEmail = $_POST["invitedUser"];

	// Query to insert into trips table
	$sql = "INSERT INTO trips (userId, name, startDate, endDate, description, location)
	VALUES ('$tripUserId', '$tripName', '$tripStartDate', '$tripEndDate', '$tripDescription', '$tripLocation')";
	
	// Confirm added to DB
	if (mysqli_query($conn, $sql)) {
	    
	    // Get the ID from the last insert and set $trip_id
	    $trip_id = mysqli_insert_id($conn);
	    echo "successfully added to db";

		} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
 
 	//insert creator of trip to participants table 
	$sql2 = "INSERT INTO participants (trip_id, user_id) VALUES ('$trip_id', '$tripUserId')";

	if (mysqli_query($conn, $sql2)) {
			// Close connection
			//mysqli_close($conn);
		} else {
		    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
		}

	//FOR NEXT SESSION
	
		//query: select the userID of the invited user
		$part_id =  getUserId($partEmail);
		 

		//save user id in function?


		//query: insert invited user ID, tripID to participants table
		insertParticipant ($trip_id, $part_id);

	
// Close connection
mysqli_close($conn);

} else { //Something wrong with the trip ID
	echo "something is wrong with the trip ID";
}


// Turn location input into Lat/Long coordinates
latLong ($tripLocation);

//Display input for adding expenses
echo "<h1>" . $tripName . "</h1>";
	
echo "Add an expense below!";

echo '<form action="expenses/submit.php" method="post">';
	echo 'Expense Name: <input type="text" name="expenseTitle" id="expenseTitle"><br>';
	echo 'Cost: <input type="text" name="expenseCost" id="expenseCost"><br>';
	echo 'Number of Purchasers: <input type="text" name="expensePurchasers" id="expensePurchasers"><br>';
	echo 'Number of Users: <input type="text" name="expenseUsers" id="expenseUsers"><br>';
	echo '<input type="hidden" name="tripId" value="' . $trip_id . '">';
	echo '<input type="submit">';
echo '</form>';

?>



<br>
<iframe
  width="450"
  height="250"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyANQeFfFVmE-Kyw1SJ5bbarzfhAvokDfQY&q=<?php echo $tripLocation; ?>" allowfullscreen>
</iframe>



</body>
</html>