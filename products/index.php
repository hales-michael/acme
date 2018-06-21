
<?php

// Products Controller

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
	$action = filter_input(INPUT_GET, 'action');
}

 // Create or access a Session
 session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
//Get the products model
require_once '../model/products-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of categories
$categories = getCategories();
 
/* // Build a navigation bar using the $categories array
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
$catList = "<select name='categoryId' id='categoryId'>";
$catList .= "<option disabled selected value>-- Please choose a category --</option>";
foreach ($categories as $category) {
	$navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>
        $category[categoryName]</a></li>";
    $catList .= "<option value=".$category['categoryId'].">".$category['categoryName']."</option>";
    }

$navList .= '</ul>';
$catList .= '</select>';

 
 */

 // Build Navigation Menu

 $navList = buildNav($categories);

switch ($action){


	case 'newCat':
		include '../view/addcategory.php';
		break;


	case 'newProduct':
		include '../view/addproduct.php';
		break;


	case 'addcategory':
        // Filter and store the data
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

        if(empty($categoryName)){
            $message = '<div class="errorMessage">*** Please enter a new category name. ***</div>';
            include '../view/addcategory.php';
            exit;
        }

        $newCatOutcome = insertCategory($categoryName);

        // Check and report the result
        if($newCatOutcome === 1){
            $message = "<div class='errorMessage'>The ".$categoryName." category has been successfully added.</div>";
        //  include '../view/products.php';
			header('Location: /acme/products/');
            exit;
        } else {
            $message = "<div class='errorMessage'>Sorry, but the category was not succesfully added. Please try again.</div>";
            include '../view/addcategory.php';
            exit;
        }
		break;

	case 'addproduct':

	// include '../view/addproduct.php';

	    // Filter and store the data
		$invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
		$invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
		$invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
		$invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
		$invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
		$invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
		$invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
		$invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
		$categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
		$invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
		$invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
		$checkPrice = checkPrice($invPrice);

		//check for empty or invalid price
			if(empty($checkPrice)) {
				$message = '<div class="errorMessage">Please enter a valid price.</div>';
				include '../view/addproduct.php';
			exit; 
			}

		if(empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || 
			empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle))  {
				$message = '<div class="errorMessage">Please complete all fields.</div>';
				include '../view/addproduct.php';
        exit;
        }

		$addProductOutcome = insertProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, 
			$invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

		if($addProductOutcome == 1){
			$message = '<p>The new product has been successfully added.</p>';
//			header('Location: /acme/product/');
			include '../view/products.php';
			exit;
		} else {
			$message = '<p>Sorry, but the product was not successfully added. Please try again.</p>';
			include '../view/addproduct.php';
			exit;
		}


		break;

	case 'mod':
		$invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		$prodInfo = getProductInfo($invId);
		if(count($prodInfo)<1){
			$message = 'Sorry, no product information could be found.';
		}
		include '../view/prod-update.php';
		exit;
	break;

	default:

		$products = getProductBasics();
		if(count($products) > 0){
			$prodList = '<table>';
			$prodList .= '<thead>';
			$prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
			$prodList .= '</thead>';
			$prodList .= '<tbody>';
			foreach ($products as $product) {
				$prodList .= "<tr><td>$product[invName]</td>";
				$prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
				$prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
			}
			$prodList .= '</tbody></table>';
		} else {
			$message = '<p class="notify">Sorry, no products were returned.</p>';
}

		include '../view/products.php';
}
?>