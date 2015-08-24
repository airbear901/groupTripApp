<!DOCTYPE html>
<html>
<head>
	<?php include 'functions.php'; ?>
</head>
<body>

<form action="submit.php" method="post">
	Expense Name: <input type="text" name="expenseTitle"><br>
	Cost: <input type="text" name="expenseCost"><br>
	Number of Purchasers: <input type="text" name="expensePurchasers"><br>
	Number of Users: <input type="text" name="expenseUsers"><br>
	<input type="submit">
</form>

</body>
</html>