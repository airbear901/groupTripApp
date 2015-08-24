<html>
<head>
	<?php include 'includes/connectToDb.php'; ?>
</head>
<body>

<?php

// Define variables
$tripName = $_POST["tripName"];
$tripStartDate = $_POST["tripStartDate"];
$tripEndDate = $_POST["tripEndDate"];
$tripDescription= $_POST["tripDescription"];
$tripLocation= $_POST["tripLocation"];

// Query to insert into myDB, table MyGuests
$sql = "INSERT INTO trips (name, startDate, endDate, description, location)
VALUES ('$tripName', '$tripStartDate', '$tripEndDate', '$tripDescription', '$tripLocation')";

// Confirm added to DB
if (mysqli_query($conn, $sql)) {
    
    // Get the ID from the last insert
    $last_id = mysqli_insert_id($conn);

    echo "Your trip has been created successfully <br> Add an expense below!";

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



</body>
</html>