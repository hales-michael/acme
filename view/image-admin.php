<?php
if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
      <title>Image Management | ACME: Your one stop shop for all things Roadrunner-Murdery </title>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

</head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
        <main>
            <p>Welcome to the Image Management page. Please choose one of the options below.</p>
			<h2>Add New Product Image</h2>
			<?php
			if (isset($message)) {
				echo $message;
			} ?>

			<form action="/acme/uploads/" method="post" enctype="multipart/form-data">
				<label for="invItem">Product</label>
				<br />
				<?php echo $prodSelect; ?>
				<br />
				<br />
				<label>Upload Image:</label>
				<br />
				<input type="file" name="file1" />
				<br />
				<input type="submit" class="regbtn" value="Upload" />
				<input type="hidden" name="action" value="upload" />
			</form>
			<hr />
			<h2>Existing Images</h2>
			<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
			<?php
			if (isset($imageDisplay)) {
				echo $imageDisplay;
 } ?>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
<?php unset($_SESSION['message']); ?>