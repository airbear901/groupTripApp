<html>
<body>

<?php
$expenseTitle = $_POST["expenseTitle"];
$expenseCost = $_POST["expenseCost"];
$expensePurchasers = $_POST["expensePurchasers"];
$expenseUsers= $_POST["expenseUsers"];
$costPp = $expenseCost / $expenseUsers;
$spendPp = $expenseCost / $expensePurchasers;
$owedToPurchasers = $costPp - $spendPp;

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