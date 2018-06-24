<?php

/* Accounts Model */

// Insert site visitor data to database
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
     VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
 $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
 $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
 $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Close the database interaction
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// Check for unique registrations
function checkExistingEmail($clientEmail) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
 // Insert the data
 $stmt->execute();
 
 $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
  // Close the database interaction
 $stmt->closeCursor();


 if(empty($matchEmail)) {
	return 0;

 } else {
	return 1;

   }
 }

 // Get client data based on an email address
function getClient($clientEmail){
 $db = acmeConnect();
 $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
         FROM clients
         WHERE clientEmail = :email';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
 $stmt->execute();
 $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $clientData;
}

function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId) {
	$db = acmeConnect();
	$sql = 'UPDATE clients
		SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail
		WHERE clientId = :clientId';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
	$stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
	$stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
	$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
	$stmt->execute();
	$rowsChanged = $stmt->rowCount();
	$stmt->closeCursor();
	return $rowsChanged;
}

 // Get client data based on the clientID
function getClientData($clientId){
 $db = acmeConnect();
 $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
         FROM clients
         WHERE clientId = :clientId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
 $stmt->execute();
 $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $clientData;
}

function updatePassword($hashedPassword, $clientId) {
	$db = acmeConnect();
	$sql = 'UPDATE clients
		SET clientPassword = :hashedPassword
		WHERE clientId = :clientId';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
	$stmt->bindValue(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
	$stmt->execute();
	$rowsChanged = $stmt->rowCount();
	$stmt->closeCursor();
	return $rowsChanged;
}