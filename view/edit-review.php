<!DOCTYPE html>
<html lang='en'>
<head>
    <title>ACME: Your one stop shop for all things Roadrunner-Murdery </title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
    </header>
    <main>
        <div class="formtext">
            <h2>Edit Review</h2>
        </div>
        <div class="container">
             <?php
            if (isset($_SESSION['message'])) {
                 echo $_SESSION['message'];
                 unset($_SESSION['message']);
            }



             ?>
            <form action="/acme/reviews/index.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="reviewText">Review Text</label>
                    </div>
                    <div class="col-75">
                        <textarea id="reviewText" name="reviewText" required><?php echo $review['reviewText']; ?> </textarea>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" name="submit" value="Submit" />
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="doReviewEdit" />
                    <input type="hidden" name="reviewId" <?php echo "value=$reviewId"; ?> />
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
    </footer>
</body>
</html>
