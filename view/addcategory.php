<!DOCTYPE html>
<html lang="en">
<head>
      <title>ACME: Your one stop shop for all things Roadrunner-Murdery </title>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/head.php'; ?>

</head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/header.php'; ?>
        </header>
        <main>
			<div class="formtext">
				<h2>Add Category</h2>
				</div>
			<div class="container">
				<?php
					if (isset($message)) {
						echo $message;
					}
                ?>
				<form action="/acme/products/index.php" method="post">
				<div class="row">
					<div class="col-25">
						<label for="categoryName">New Category Name</label>
					</div>
					<div class="col-75">
                        <input type="text" id="categoryName" name="categoryName" required />
					</div>
				 </div>
				<div class="row">
                    <input type="submit" name="submit" value="Submit" />
					<!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="addcategory" />
				</div>
				</form>
			</div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
