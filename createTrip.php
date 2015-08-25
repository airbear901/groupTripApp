<html>
<head>
	<?php include 'includes/connectToDb.php'; ?>
</head>
<body>

<?php

// Define variables
$tripName = $_POST["tripName"];
$tripStartDate = $_POST["from"];
$tripEndDate = $_POST["to"];
$tripDescription= $_POST["tripDescription"];
$tripLocation= $_POST["tripLocation"];
$tripUserId= $_POST["user_id"];


// Turn location input into Lat/Long coordinates

	$maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($tripLocation);

	$maps_json = file_get_contents($maps_url);
	$maps_array = json_decode($maps_json, true);

	$lng = $maps_array['results'][0]['geometry']['location']['lng'];
	$lat = $maps_array['results'][0]['geometry']['location']['lat'];


// Query to insert into myDB, table MyGuests
$sql = "INSERT INTO trips (userId, name, startDate, endDate, description, location)
VALUES ('$tripUserId', '$tripName', '$tripStartDate', '$tripEndDate', '$tripDescription', '$tripLocation')";

// Confirm added to DB
if (mysqli_query($conn, $sql)) {
    
    // Get the ID from the last insert
    $last_id = mysqli_insert_id($conn); ?>

<h1><?php echo $tripName ?></h1>
<?php
    echo "Add an expense below!";

		echo '<form action="submit.php" method="post">';
			echo 'Expense Name: <input type="text" name="expenseTitle" id="expenseTitle"><br>';
			echo 'Cost: <input type="text" name="expenseCost" id="expenseCost"><br>';
			echo 'Number of Purchasers: <input type="text" name="expensePurchasers" id="expensePurchasers"><br>';
			echo 'Number of Users: <input type="text" name="expenseUsers" id="expenseUsers"><br>';
			echo '<input type="hidden" name="tripId" value="' . $last_id . '">';
			echo '<input type="submit">';
		echo '</form>';

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
// Close connection
mysqli_close($conn);

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