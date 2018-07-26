<?php

/* TASKS
	x Insert a review
	x Get reviews for a specific inventory item
	x Get reviews written by a specific client
	x Get a specific review
	x Update a specific review
	x Delete a specific review
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
}

// Get reviews for a specific inventory item
function getReviewsByItem($invId) {
	$db = acmeConnect();
	$sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, i.invName, c.clientFirstname, c.clientLastname
            FROM reviews r, inventory i, clients c
            WHERE i.invId = :invId
            AND r.invId = :invId
            AND r.clientId = c.clientId';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
	$stmt->execute();
	$itemReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $itemReviews;
}

/* // Get reviews written by a specific client
function getReviewByClient($clientId) {
	$db = acmeConnect();
	$sql = 'SELECT * FROM reviews WHERE clientId = :clientId';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
	$stmt->execute();
	$clientReview = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
   return $clientReview;
} */

// Get reviews written by a specific client
function getReviewsByClientId($clientId) {
	$db = acmeConnect();
	$sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, i.invName, c.clientFirstname, c.clientLastname
			FROM reviews r, inventory i, clients c
			WHERE c.clientId = :clientId
               AND r.clientId = :clientId
			AND i.invId = r.invId;';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
	$stmt->execute();
	$clientReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
   return $clientReviews;
}

// Get a specific review
function getSpecificReview($reviewId) {
	$db = acmeConnect();
	$sql = 'SELECT r.reviewText, r.reviewDate, i.invName 
          FROM reviews r, inventory i
          WHERE reviewId = :reviewId
          AND i.invId = r.invId;';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
	$stmt->execute();
	$review = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $review;
}

// Update a specific review
function updateReview($reviewId, $reviewText) {
	$db = acmeConnect();
	$sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId =:reviewId';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
	$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
	$stmt->execute();
	$rowsChanged = $stmt->rowCount();
	$stmt->closeCursor();
	return $rowsChanged;
}

// Delete a specific review
function deleteReview($reviewId) {
	$db = acmeConnect();
	$sql = 'DELETE FROM reviews WHERE reviewId =:reviewId';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
	$stmt->execute();
	$rowsChanged = $stmt->rowCount();
	$stmt->closeCursor();
	return $rowsChanged;
}