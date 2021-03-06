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

function buildProductsDisplay($products){
	$pd = '<ul id="prod-display">';
	foreach ($products as $product) {
		$pd .= '<li>';
		$pd .= "<a href='/acme/products/index.php?action=detail&invId=$product[invId]'><img src='$product[invThumbnail]' alt='Image of $product[invName] on
			Acme.com'>";
		$pd .= '<hr>';
		$pd .= "<h2>$product[invName]</h2>";
		$pd .= "<span>$product[invPrice]</span></a>";
		$pd .= '</li>';
	}
	$pd .= '</ul>';
	return $pd;
}

function productDisplay($prodDetail) {

	$pd = "<div class='detailwrapper'><img id='itemMainImage' src='";
	$pd .= $prodDetail['invImage'];
	$pd .= "' alt='";
	$pd .= $prodDetail['invName'];
	$pd .= "'/><div class='details'><h1>";
	$pd .= $prodDetail['invName'];
	$pd .= "</h1><p>In Stock: ";
	$pd .= $prodDetail['invStock'];
	$pd .= "</p><p>Size: ";
	$pd .= $prodDetail['invSize'];
	$pd .= "</p><p>Weight: ";
	$pd .= $prodDetail['invWeight'];
	$pd .= "</p><p>Style: ";
	$pd .= $prodDetail['invStyle'];
	$pd .= "</p><p>Location: ";
	$pd .= $prodDetail['invLocation'];
	$pd .= "</p><div class='description'><h3>Product Description</h3><p>";
	$pd .= $prodDetail['invDescription'];
	$pd .= "</p></div><div class='price'><h3>Price: $";
	$pd .= $prodDetail['invPrice'];
	$pd .= "</h3></div></div></div>";

return $pd;
}

function thumbnailDisplay($thumbArray) {

	$td =  "<div class='thumbwrapper' >";
	foreach ($thumbArray as $thumb) {
		$td .= "<img src='$thumb[imgPath]' alt='Thumbnail of $thumb[imgName]' class='imageThumb' />";
	}

	$td .= "</div>";
	return $td;
}


/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
 $i = strrpos($image, '.');
 $image_name = substr($image, 0, $i);
 $ext = substr($image, $i);
 $image = $image_name . '-tn' . $ext;
 return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
 $id = '<ul id="image-display">';
 foreach ($imageArray as $image) {
  $id .= '<li>';
  $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
  $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
  $id .= '</li>';
 }
 $id .= '</ul>';
 return $id;
}

// Build the products select list
function buildProductsSelect($products) {
 $prodList = '<select name="invId" id="invId">';
 $prodList .= "<option>Choose a Product</option>";
 foreach ($products as $product) {
  $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
 }
 $prodList .= '</select>';
 return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
 // Gets the paths, full and local directory
 global $image_dir, $image_dir_path;
 if (isset($_FILES[$name])) {
  // Gets the actual file name
  $filename = $_FILES[$name]['name'];
  if (empty($filename)) {
   return;
  }
 // Get the file from the temp folder on the server
 $source = $_FILES[$name]['tmp_name'];
 // Sets the new path - images folder in this directory
 $target = $image_dir_path . '/' . $filename;
 // Moves the file to the target folder
 move_uploaded_file($source, $target);
 // Send file for further processing
 processImage($image_dir_path, $filename);
 // Sets the path for the image for Database storage
 $filepath = $image_dir . '/' . $filename;
 // Returns the path where the file is stored
 return $filepath;
 }
}

// Processes images by getting paths and
// creating smaller versions of the image
function processImage($dir, $filename) {
 // Set up the variables
 $dir = $dir . '/';

 // Set up the image path
 $image_path = $dir . $filename;

 // Set up the thumbnail image path
 $image_path_tn = $dir.makeThumbnailName($filename);

 // Create a thumbnail image that's a maximum of 200 pixels square
 resizeImage($image_path, $image_path_tn, 200, 200);

 // Resize original to a maximum of 500 pixels square
 resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {

 // Get image type
 $image_info = getimagesize($old_image_path);
 $image_type = $image_info[2];

 // Set up the function names
 switch ($image_type) {
 case IMAGETYPE_JPEG:
  $image_from_file = 'imagecreatefromjpeg';
  $image_to_file = 'imagejpeg';
 break;
 case IMAGETYPE_GIF:
  $image_from_file = 'imagecreatefromgif';
  $image_to_file = 'imagegif';
 break;
 case IMAGETYPE_PNG:
  $image_from_file = 'imagecreatefrompng';
  $image_to_file = 'imagepng';
 break;
 default:
  return;
} // ends the resizeImage function

 // Get the old image and its height and width
 $old_image = $image_from_file($old_image_path);
 $old_width = imagesx($old_image);
 $old_height = imagesy($old_image);

 // Calculate height and width ratios
 $width_ratio = $old_width / $max_width;
 $height_ratio = $old_height / $max_height;

 // If image is larger than specified ratio, create the new image
 if ($width_ratio > 1 || $height_ratio > 1) {

  // Calculate height and width for the new image
  $ratio = max($width_ratio, $height_ratio);
  $new_height = round($old_height / $ratio);
  $new_width = round($old_width / $ratio);

  // Create the new image
  $new_image = imagecreatetruecolor($new_width, $new_height);

  // Set transparency according to image type
  if ($image_type == IMAGETYPE_GIF) {
   $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
   imagecolortransparent($new_image, $alpha);
  }

  if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
   imagealphablending($new_image, false);
   imagesavealpha($new_image, true);
  }

  // Copy old image to new image - this resizes the image
  $new_x = 0;
  $new_y = 0;
  $old_x = 0;
  $old_y = 0;
  imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

  // Write the new image to a new file
  $image_to_file($new_image, $new_image_path);
  // Free any memory associated with the new image
  imagedestroy($new_image);
  } else {
  // Write the old image to a new file
  $image_to_file($old_image, $new_image_path);
  }
  // Free any memory associated with the old image
  imagedestroy($old_image);
} // ends the if - else began on line 36

function buildAdminReviewDisplay($clientId) {

	$reviewArray = getReviewsByClientId($clientId);



    if (is_array($reviewArray)) {
	   if(count($reviewArray)<1){
		  $rv =  "Sorry, you have not submitted any reviews.";
	   } else {
		  $rv = '<div id="admin-reviews">';
            $rv .= '<div class=reviewHead>Manage Your Product Reviews</div>';
            $rv .= "<table><tbody>";
		  foreach ($reviewArray as $review) {
                $rv .= "<tr><td><p>";
                $rv .= "<span class='reviewText'>";
			 $rv .= $review['reviewText'];
			 $rv .= '</span></p></td><td>(Reviewed on ';
			 $rv .= date("M d \, Y", strtotime($review['reviewDate']));
			 $rv .= "):</td><td><a href='/acme/reviews?action=editReview&reviewId=$review[reviewId]' title='Edit Review'>Edit |</a> </td><td>
			<a href='/acme/reviews?action=deleteReview&reviewId=$review[reviewId]' title='Delete Review'>Delete </a>";
			 $rv .= '</td></tr>';
		  }
            $rv .= "</tbody></table>";
		  $rv .= '</div>';
	   }
    } else {
	   $rv = 'not an array';
    }
    return $rv;
}


function productReviewDisplay($invId) {

    $reviewArray = getReviewsByItem($invId);

    $prd = "<div class='productReviewWrapper'><h2>Customer Reviews</h2>";

    if(count($reviewArray)<1){
	  $prd  .=  "<div class='productReviewMessage'>Sorry, There are no reviews for this product.</div></div>";
    } else {
	  $prd .= '<table>';
	  $prd .= '<thead>';
	  //$prd .= '<tr><th>Product Reviews</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
	  $prd .= '</thead>';
	  $prd .= '<tbody>';
	  foreach ($reviewArray as $review) {
          $screenName = substr($review['clientFirstname'], 0, 1) . $review['clientLastname'];
		$prd .= "<tr><td><p><span>$screenName</span> wrote on ". date("M d \, Y", strtotime($review['reviewDate'])). ":</td>";
		$prd .= "<td>$review[reviewText]</td>";
	  }
	  $prd .= '</tbody></table></div>';
	  }
    return $prd;
    }

function buildNewReviewForm($screenName, $invId) {

     if(empty($screenName)) {
          $rf = "<div class='loginMessage'><h4>You must be logged in to write a review. <a href='/acme/accounts/index.php?action=login'>Click here</a> to login.</h4></div>";
     } else {
          $rf = "<div class='container'><form action='/acme/reviews/index.php' method='post'><div class='row'><div class='col-25'><label for='screenName'>Screen Name</label></div>
          <div class='col-75'><input type='text' id='screenName' name='screenName' readonly ";
          if(isset($screenName)) { $rf .= "value ='$screenName'";}
          $rf .= "/> </div></div>";
          $rf .= "<div class='row'><div class='col-25'><label for='reviewText'>Review Text</label></div>
          <div class='col-75'><input type='text' id='reviewText' name='reviewText' required /> </div></div>";
          $rf .= "<div class = 'row'><input type='submit' name='submit' value='submit' />";
          $rf .= "<input type='hidden' name='action' value='addNewReview' />";
          $rf .= "<input type='hidden' name='invId' value=$invId /></div>";
          $rf .= "</form></div></div>";
     }
     return $rf;
}

?>