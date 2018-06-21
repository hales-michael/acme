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
	$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
	
	foreach ($categories as $category) {
		$navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>
			$category[categoryName]</a></li>";
    }
	$navList .= '</ul>';

	return $navList;

}

function checkPrice ($invPrice) {
	$pattern = '/\d+(?:\.\d{1,2})?/';
	return preg_match ($pattern, $invPrice);
}

?>