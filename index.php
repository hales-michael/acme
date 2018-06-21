<?php

// Main Controller

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 // Create or access a Session
 session_start();

// Get the database connection file
 require_once 'library/connections.php';
 // Get the acme model for use as needed
 require_once 'model/acme-model.php';
 // Get functions
 require_once 'library/functions.php';


 // Get the array of categories
	$categories = getCategories();
//	var_dump($categories);
//	exit;

// Build a navigation bar using the $categories array
 $navList = buildNav($categories);

  //Check for firstname cookie
if(isset($_COOKIE['firstname'])){
 $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

 switch ($action){

 case 'something':
	break;

 default:
   include 'view/home.php';
}