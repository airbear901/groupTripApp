<html>
<head>
	<?php include 'includes/connectToDb.php'; ?>
</head>
<body>

<?php
$expenseTitle = $_POST["expenseTitle"];
$expenseCost = $_POST["expenseCost"];
$expensePurchasers = $_POST["expensePurchasers"];
$expenseUsers= $_POST["expenseUsers"];
$tripId= $_POST["tripId"];
$costPp = $expenseCost / $expenseUsers;
$spendPp = $expenseCost / $expensePurchasers;
$owedToPurchasers = $costPp - $spendPp;

// Query to insert into expenses
$sql = "INSERT INTO expenses (tripId, name, totalCost, numberOfPurchasers, numberOfUsers)
VALUES ('$tripId', '$expenseTitle', '$expenseCost', '$expensePurchasers', '$expenseUsers')";

// Confirm added to DB
if (mysqli_query($conn, $sql)) {
	
	echo "successfully added to db";



	} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);


?>


Expense Title <?php echo $expenseTitle; ?><br>

<br>

Your Total Cost is: <?php echo $expenseCost; ?><br>
Number of purchasers: <?php echo $expensePurchasers; ?><br>
Cost to each purchaser: <?php echo $spendPp; ?><br>
Number of users: <?php echo $expenseUsers; ?><br>
Cost to each user: <?php echo $costPp; ?><br>
Amount owed to purchasers : <?php echo $owedToPurchasers; ?><br>

<br>

<?php 
if ($owedToPurchasers < 0) {
	echo 'Each purchaser is owed $' . ($owedToPurchasers * -1);
} elseif ($owedToPurchasers === 0) {
	echo 'Purchasers dont owe anything and arent owed anything';
} else {
	echo 'Each purchaser owes $' . ($owedToPurchasers * -1);
}

?>

</body>
</html>