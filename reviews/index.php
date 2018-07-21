
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
     * 1. Add a new review
     * 2. Deliver a view to edit a review.
     * 3. Handle the review update.
     * 4. Deliver a view to confirm deletion of a review.
     * 5. Handle the review deletion.
     * 6. A default that will deliver the "admin" view if the client is logged in or the
     *   acme home view if not.
     */

    case 'addReview':
        // Filter and store the data
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        // $invId = SOMETHING;
        $clientId = $_SESSION['clientData']['clientId'];


        if(empty($reviewText)){
            $message = '<div class="errorMessage">*** Review field cannot be blank. ***</div>';
            include '../view/addreview.php';
            exit;
        }

        $newReviewOutcome = insertReview($reviewText, $invId, $clientId);

        // Check and report the result
        if($newCatOutcome === 1){
            $message = "<div class='errorMessage'>The review has been successfully added.</div>";

			header('Location: /acme/reviews/');
            exit;
        } else {
            $message = "<div class='errorMessage'>Sorry, but the review was not succesfully added. Please try again.</div>";
            include '../view/addreview.php';
            exit;

        }

    break;

	default:
        include '../view/admin.php';

}
?>