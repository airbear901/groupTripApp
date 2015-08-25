<!DOCTYPE html>
<html>
<head>
    <?php  ?> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script script type="text/javascript" src="js/script.js"></script>  
</head>
<body>

<?php
/**
 * A simple PHP Login Script / ADVANCED VERSION
 *
 * @link https://github.com/devplanete/php-login-advanced
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load php-login class
require_once("PHPLogin.php");
// the login object will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new PHPLogin();

include('views/_header.php');

// show the registration form
if (isset($_GET['register']) && ! $login->isRegistrationSuccessful() && 
   (ALLOW_USER_REGISTRATION || (ALLOW_ADMIN_TO_REGISTER_NEW_USER && $_SESSION['user_access_level'] == 255))) {
    include('views/register.php');

// show the request-a-password-reset or type-your-new-password form
} else if (isset($_GET['password_reset']) && ! $login->isPasswordResetSuccessful()) {
    if (isset($_REQUEST['user_name']) && isset($_REQUEST['verification_code']) && $login->isPasswordResetLinkValid()) {
        // reset link is correct: ask for the new password
        include("views/password_reset.php");
    } else {
        // no data from a password-reset-mail has been provided, 
        // we show the request-a-password-reset form
        include('views/password_reset_request.php');
    }

// show the edit form to modify username, email or password
} else if (isset($_GET['edit']) && $login->isUserLoggedIn()) {
    include('views/edit.php');

// the user is logged in, we show informations about the current user
} else if ($login->isUserLoggedIn()) {
    include('views/logged_in.php'); 
    include ('includes/functions.php');
    
   $userTrips = getTrips($_SESSION['user_id']);
    

    echo "<table cellpadding=1 class='table tablesorter' id='thetable'>"; 
        echo "<thead>";
        echo "<th>Trip Name</th><th>Date</th><th>Location</th>";
        echo "</thead>";
         while($info = mysqli_fetch_array( $userTrips )) 
         { 
        echo "<tr>"; 
        echo "<td>".$info['name'] . "</td> "; 
        echo "<td>".$info['startDate'] . "</td> ";
        echo "<td>".$info['location'] . "</td></tr> ";
        } 
        echo "</table>"; 



    ?>


<h1>Create a Trip</h2>
<form action="createTrip.php" method="post">
    Trip Name: <input type="text" name="tripName" id="tripName"><br>
    <label for="from">From</label><input type="text" id="from" name="from"><br>
    <label for="to">to</label><input type="text" id="to" name="to"><br>
    Description: <input type="textarea" name="tripDescription" id="tripDescription"><br>
    Location: <input type="text" name="tripLocation" id="tripLocation"><br>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id'];?>"><br>
    <input type="submit">
</form>


<?php

// the user is not logged in, we show the login form
} else {
    include('views/login.php');
}

include('views/_footer.php');
?>



</body>
</html>
