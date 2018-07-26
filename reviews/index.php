
<?php

// Reviews Controller

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
// Get the uploads model
require_once '../model/uploads-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';

// Get the array of categories
$categories = getCategories();


// Build Navigation Menu
$navList = buildNav($categories);

switch ($action){



	/* Needed cases:
	 x 1. Add a new review
	 x 2. Deliver a view to edit a review.
	 x 3. Handle the review update.
	 x 4. Deliver a view to confirm deletion of a review.
	 x 5. Handle the review deletion.
	 * 6. A default that will deliver the "admin" view if the client is logged in or the
	 *   acme home view if not.
	 */

	case 'addNewReview':
		// Filter and store the data
		$invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
		$reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);


		$clientId = $_SESSION['clientData']['clientId'];


		if(empty($reviewText)){
			$_SESSION['message'] = '<div class="errorMessage">*** Review Text field cannot be blank. ***</div>';
			header('location: /acme/products/index.php?action=detail&invId=' . $invId);
			exit;
		}

		$newReviewOutcome = insertReview($reviewText, $invId, $clientId);

		// Check and report the result
		if($newReviewOutcome === 1){
			$_SESSION['message'] = "<div class='errorMessage'>The review has been successfully added.</div>";

			header('location: /acme/products/index.php?action=detail&invId=' . $invId);
			exit;
		} else {
			$_SESSION['message'] = "<div class='errorMessage'>Sorry, but the review was not succesfully added. Please try again.</div>";
			header('location: /acme/products/index.php?action=detail&invId=' . $invId);
			exit;

		}

	break;

	case 'editReview':
          $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
          $review = getSpecificReview($reviewId);

		include '../view/edit-review.php';


	break;

	case 'doReviewEdit':

          $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
          $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT);


		if(empty($reviewText)){
			$_SESSION['message'] = '<div class="errorMessage">*** Review Text field cannot be blank. ***</div>';
			header('location: /acme/reviews/index.php?action=editReview&reviewId=' . $reviewId);
			exit;
		}

		$updateReviewOutcome = updateReview($reviewId, $reviewText);

		// Check and report the result
		if($updateReviewOutcome === 1){
			$_SESSION['message'] = "<div class='errorMessage'>The review has been successfully updated.</div>";

			header('location: /acme/accounts/index.php?action=admin');
			exit;
		} else {
			$_SESSION['message'] = "<div class='errorMessage'>Sorry, but the review was not succesfully updated. Please try again.</div>";
			header('location: /acme/accounts/index.php?action=admin');
			exit;

		}

	break;

     case 'deleteReview':

          $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
          $review = getSpecificReview($reviewId);

          include '../view/delete-review.php';


     break;

     case 'doReviewDelete':

          $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT);

          $deleteReviewOutcome = deleteReview($reviewId);

          if($deleteReviewOutcome === 1){
			$_SESSION['message'] = "<div class='errorMessage'>The review has been successfully deleted.</div>";

			header('location: /acme/accounts/index.php?action=admin');
			exit;
		} else {
			$_SESSION['message'] = "<div class='errorMessage'>Sorry, but the review was not succesfully deleted. Please try again.</div>";
			header('location: /acme/accounts/index.php?action=admin');
			exit;

		}



     break;


	default:
		include '../view/admin.php';

}
?>