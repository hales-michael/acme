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

	$pd = "<div class='detailwrapper'><img src='/acme/images/products/";
	$pd .= $prodDetail['invImage'];
	$pd .= "alt='$prodDetail[invName']/><div class='details'><h3>";
	$pd .= $prodDetail['invName'];
	$pd .= "</h3><p>In Stock: ";
	$pd .= $prodDetail['invStock'];
	$pd .= "</p><p>Size: ";
	$pd .= $prodDetail['invSize'];
	$pd .= "</p><p>Weight: "
	$pd .= <?php echo $prodDetail['invWeight']; ?> </p>
					 <p>Style: <?php echo $prodDetail['invStyle']; ?> </p>
					 <p>Location: <?php echo $prodDetail['invLocation']; ?> </p>
					 <div class='description'>
						<p><?php echo $prodDetail['invDescription']; ?> </p>
					</div>
					<div class='price'>
						<h3>Price: <?php echo $prodDetail['invPrice']; ?> </h3>
					</div>
				</div>
			</div>






?>