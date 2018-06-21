<?php
if(!$_SESSION['loggedin']){
//echo $SESSION['loggedin'];
	include '../index.php';

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
		<div class="mainwrapper">
            <h1>
				<?php // echo var_dump($_SESSION);
				echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname'];	?>
			</h1>
			<div class="userdata">
				<ul>
						<?php if($_SESSION['clientData']['clientLevel'] == 3) {
							$accessLevel = 'Admin';
							} else {
							$accessLevel = 'Basic'; } ?>
						<li><?php echo "First Name: " . $_SESSION['clientData']['clientFirstname']; ?></li>
						<li><?php echo "Last Name: " . $_SESSION['clientData']['clientLastname']; ?></li>
						<li><?php echo "Email Address: " . $_SESSION['clientData']['clientEmail']; ?></li>
						<li><?php echo "Access Level: $accessLevel" ?></li>
					</ul>
				</div>
			<?php
				if($_SESSION['clientData']['clientLevel'] > 1) {
					echo "<div class='productsLink'><a href='../products/'>Product Management Page</a></div>";
				}
				?>
		</div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>