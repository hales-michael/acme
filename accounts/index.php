<?php
// Accounts Controller

 // Create or access a Session
	 if(!isset($_SESSION)) {
		session_start();
	}


// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 // Get the accounts model
 require_once '../model/accounts-model.php';
 // Get functions
 require_once '../library/functions.php';
 // Get the reviews model
 require_once '../model/reviews-model.php';

 // Get the array of categories
	$categories = getCategories();


// Build a navigation bar using the $categories array
 $navList = buildNav($categories);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
 case 'login':
	$_SESSION['loggedin'] = FALSE;
	include '../view/login.php';
  break;

 case 'registration':
	include '../view/registration.php';
	 break;

 case 'register':

	 // Filter and store the data
	 $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
	 $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
	 $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
	 $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
	 $clientEmail = checkEmail($clientEmail);
	 $checkPassword = checkPassword($clientPassword);

	 //  Existing Email Check
	 $existingEmail = checkExistingEmail($clientEmail);
	 if($existingEmail) {
		 // $message
		 $_SESSION['message'] = '<div class="errorMessage">Email address already exists. Please login.</div>';
		 include '../view/login.php';
		 exit;
	 }

	 if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
		 // $message
		 $_SESSION['message'] = '<div class="errorMessage">Please provide information for all empty form fields.</div>';
		 include '../view/registration.php';
		 exit;
	 }

	 $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

	 $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

	 // Check and report the result
	 if($regOutcome === 1) {
		 setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
		 $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";

		 header('Location: /acme/accounts/?action=login');
		 exit;
	 } else {
		 // $message =
		 $_SESSION['message'] = "<div>Sorry $clientFirstname, but the registration failed. Please try again.</div>";
		 include '../view/registration.php';
		 exit;
	 }

	 break;

case 'doLogin':

	$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
	$clientEmail = checkEmail($clientEmail);
	$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
	$passwordCheck = checkPassword($clientPassword);

	// Run basic checks, return if errors
	if (empty($clientEmail) || empty($passwordCheck)) {
		// $message
		$_SESSION['message'] = "<p class='notice'>Please provide a valid email address and password.</p>";
		include '../view/login.php';
		exit;
	}

	// A valid password exists, proceed with the login process
	// Query the client data based on the email address
	$clientData = getClient($clientEmail);
	// Compare the password just submitted against
	// the hashed password for the matching client
	$hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
	// If the hashes don't match create an error
	// and return to the login view


	if(!$hashCheck) {
		// $message =
		$_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
		include '../view/login.php';
		exit;
	}
	// A valid user exists, log them in
	$_SESSION['loggedin'] = TRUE;
	// Remove the password from the array
	// the array_pop function removes the last
	// element from an array
	array_pop($clientData);
	// Store the array into the session
	$_SESSION['clientData'] = $clientData;




	// Delete firstname cookie
	setcookie('firstname', '', time() - 3600);

	// Set Screen Name
	$screenName = substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'];
	$_SESSION['screenName'] = $screenName;

	$clientId = $_SESSION['clientData']['clientId'];
	$rv = buildAdminReviewDisplay($clientId);

	include '../view/admin.php';
	exit;
	break;

	case 'admin' :

	   $clientId = $_SESSION['clientData']['clientId'];

	   $rv = buildAdminReviewDisplay($clientId);

		include '../view/admin.php';
		break;

	case 'logout' :

		// destroy the session
		session_destroy();
		session_unset();

		header('Location: /acme/index.php/');
		break;

	case 'clientUpdate' :
		include '../view/client-update.php';
		break;

	case 'updateAccount' :

		// Filter and store the data
		$clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
		$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
		$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
		$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
		$clientEmail = checkEmail($clientEmail);

		// Check email against email address from session
			if($clientEmail != $_SESSION['clientData']['clientEmail']) {
				//  Existing Email Check
				$existingEmail = checkExistingEmail($clientEmail);
				if($existingEmail) {
					// $message
					$_SESSION['message'] = '<div class="errorMessage">Email address already exists. Please try again.</div>';
					include '../view/client-update.php';
					exit;
				}
			}
		if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
			// $message
			$_SESSION['message'] = '<div class="errorMessage">Please provide information for all empty form fields.</div>';
			include '../view/client-update.php';
			exit;
		}

		$updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

		// Check and report the result
		if($updateOutcome === 1) {

			$_SESSION['message'] = "Your account has been successfully updated.";

			$clientData = getClientData($clientId);

			// Remove the password from the array
			// the array_pop function removes the last
			// element from an array
			array_pop($clientData);
			// Store the array into the session
			$_SESSION['clientData'] = $clientData;
			// Send them to the admin view
			setcookie('firstname', $_SESSION['clientData']['clientFirstname'], strtotime('+1 year'), '/');
			include '../view/admin.php';
			exit;

			include '../view/admin.php';
			exit;

		 } else {
			 // $message =
			 $_SESSION['message'] = "<div>Sorry $clientFirstname, but the Account update failed. Please try again.</div>";
			 include '../view/client-update.php';
			 exit;
	 }

	break;

	case 'changePassword' :

		$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
		$clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
		$passwordCheck = checkPassword($clientPassword);

			// Run basic checks, return if errors
		if (empty($passwordCheck)) {
			// $message
			$_SESSION['message'] = "<p class='notice'>Password field cannot be blank.</p>";
			include '../view/client-update.php';
			exit;
		}

	 $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

	 $passwordChangeOutcome = updatePassword($hashedPassword, $clientId);

	 // Check and report the result
	 if($passwordChangeOutcome === 1) {

		 $_SESSION['message'] = "Your password has been successfully changed.";

		 header('Location: /acme/accounts/?action=admin');
		 exit;
	 } else {
		 // $message =
		 $_SESSION['message'] = "<div>Sorry, the password was not successfully changed</div>";
		 include '../view/client-update.php';
		 exit;
	 }

	 break;


 default:

//echo 'Hi im default';
}