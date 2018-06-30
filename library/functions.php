<?php

function checkEmail($clientEmail) {
	$valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
	return $valEmail;
}

function checkPassword ($clientPassword) {
	$pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
	return preg_match($pattern, $clientPassword);
}

function buildNav ($categories) {
	$navList = '<ul>';
	$navList .= "<li><a href='/acme/' title='View the Acme home page'>Home</a></li>";
	
	foreach ($categories as $category) {
		$navList .= "<li>";
		$navList .= "<a href='/acme/products/?action=category&type=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";}
		$navList .= '</ul>';

	return $navList;

}

function checkPrice ($invPrice) {
	$pattern = '/\d+(?:\.\d{1,2})?/';
	return preg_match ($pattern, $invPrice);
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

function productDisplay($prodDetail) {

	$pd = "<div class='detailwrapper'><img src='";
	$pd .= $prodDetail['invImage'];
	$pd .= "' alt='";
	$pd .= $prodDetail['invName'];
	$pd .= "'/><div class='details'><h3>";
	$pd .= $prodDetail['invName'];
	$pd .= "</h3><p>In Stock: ";
	$pd .= $prodDetail['invStock'];
	$pd .= "</p><p>Size: ";
	$pd .= $prodDetail['invSize'];
	$pd .= "</p><p>Weight: ";
	$pd .= $prodDetail['invWeight'];
	$pd .= "</p><p>Style: ";
	$pd .= $prodDetail['invStyle'];
	$pd .= "</p><p>Location: ";
	$pd .= $prodDetail['invLocation'];
	$pd .= "</p><div class='description'><p>";
	$pd .= $prodDetail['invDescription'];
	$pd .= "</p></div><div class='price'><h3>Price: ";
	$pd .= $prodDetail['invPrice'];
	$pd .= "</h3></div></div></div>";

return $pd;
}

?>