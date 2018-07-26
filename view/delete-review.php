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
          <h3>Are you sure you want to delete this review?</h3>
          <form action="/acme/reviews/index.php" method="post">
               <div class="row">
                    <div class="col-25">
                         <label for="reviewText">Review Text</label>
                    </div>
                    <div class="col-75">
                         <textarea id="reviewText" name="reviewText" readonly>
                              <?php echo $review['reviewText']; ?>
                         </textarea>
                    </div>
               </div>
               <div class="row">
                    <input type="submit" name="submit" value="Confirm Deletion" />
                    <input type="hidden" name="action" value="doReviewDelete" />
                    <input type="hidden" name="reviewId" <?php echo "value=$reviewId"; ?> />
               </div>
          </form>
     </main>
     <footer>
          <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     </footer>
</body>
</html>