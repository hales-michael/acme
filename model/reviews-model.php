<?php

/* TASKS
    o Insert a review
    o Get reviews for a specific inventory item
    o Get reviews written by a specific client
    o Get a specific review
    o Update a specific review
    o Delete a specific review
    */


// Insert new review to database
function insertReview($reviewText, $invId, $clientId){
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
     VALUES (:reviewText, :invId, :clientId)';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is

    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
	$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
	$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);


    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;

    ?>