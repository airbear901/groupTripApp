<!DOCTYPE html>
<html>
<head>
	<?php include 'functions.php'; ?>
	<script script type="text/javascript" src="script.js"></script>
</head>
<body>

<form action="createTrip.php" method="post">
	Trip Name: <input type="text" name="tripName" id="tripName"><br>
	Trip Start Date: <input type="text" name="tripStartDate" id="tripStartDate"><br>
	Trip End Date: <input type="text" name="tripEndDate" id="tripEndDate"><br>
	Description: <input type="textarea" name="tripDescription" id="tripDescription"><br>
	Location: <input type="text" name="tripLocation" id="tripLocation"><br>
	<input type="submit">
</form>

</body>
</html>