<?php

/* Products Model */

// Insert new category data to database
function insertCategory($categoryName){
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'INSERT INTO categories (categoryName)
	VALUES (:categoryName)';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is

    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Insert new product data to database
function insertProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle){
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle)
	VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle )';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is

    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
	$stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
	$stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
	$stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
	$stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
	$stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
	$stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
	$stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
	$stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
	$stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
	$stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
	$stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function getProductsByCategory($type) {
	$db = acmeConnect();
	$sql = 'SELECT * FROM inventory
		WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':categoryName', $type, PDO::PARAM_STR);
	$stmt->execute();
	$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $products;
}

function getProductBasics() {
 $db = acmeConnect();
 $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

// Get product information by invId
function getProductInfo($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}

// Update product data in the database
function updateProduct($invId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle){
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock,
		invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
	// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is

	$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
     $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
	$stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
	$stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
	$stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
	$stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
	$stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
	$stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
	$stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
	$stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
	$stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
	$stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
	$stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Delete product data from the database
function deleteProduct($invId) {
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
	// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
	$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


?>