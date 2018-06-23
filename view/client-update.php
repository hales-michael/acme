<?php
if(!$_SESSION['loggedin']){
//echo $SESSION['loggedin'];
	include '../index.php';
}
?><!DOCTYPE html>
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
				<h2>Update Account</h2>
			</div>
			<div class="container">
				<form action="/acme/products/index.php" method="post">
				<div class="row" >
					<div class="col-25">
						<label for="clientFirstname">First Name</label>
					</div>
					<div class="col-75">
						<input type="text" id="clientFirstname" name="clientFirstname" required 
							<?php value = $_SESSION['clientData']['clientFirstname'] ?> >
					</div>
				</div>
				<div class="row" >
					<div class="col-25">
						<label for="clientLastname">Last Name</label>
					</div>
					<div class="col-75">
						<input type="text" id="clientLastname" name="clientLastname" required 
							<?php value = $_SESSION['clientData']['clientLastname'] ?> >
					</div>
				</div>
				<div class="row" >
					<div class="col-25">
						<label for="clientEmail">Email Address</label>
					</div>
					<div class="col-75">
						<input type="email" id="clientEmail" name="clientEmail" required 
							<?php value = $_SESSION['clientData']['clientEmail'] ?> >
					</div>
				</div>
				<div class="row">
                    <input type="submit" name="submit" value="Update Account" />
					<!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateAccount" />
				</div>
				</form>
			</div>
			<div class="formtext">
				<h2>Password Change</h2>
			</div>
			<div class="container">
				<form action="/acme/products/index.php" method="post">
				<div class="row">
					<div class="col-25">
						<label for="newPassword">New Password</label>
					</div>
					<div class="col-75">
                        <input type="password" id="newPassword" name="newPassword" required />
					</div>
				 </div>
				<div class="row">
                    <input type="submit" name="submit" value="Change Password" />
					<!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="changePassword" />
				</div>
				</form>
			</div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
