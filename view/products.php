<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}

if(isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
}
?>
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

		<?php
			if (isset($message)) {
				echo $message;
			}
		?>

		<div class='productslink'>
			<a href='../products/index.php?action=newCat'><h2>Add New Category</h2></a>
		</div>
		<div class='productslink'>
			<a href='../products/index.php?action=newProduct'><h2>Add New Product</h2></a>
		</div>
		<div>
			<?php
			if (isset($prodList)) {
				echo $prodList;
}
?>
		</div>
	</main>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
	</footer>
</body>
</html>
<?php unset($_SESSION['message']); ?>
