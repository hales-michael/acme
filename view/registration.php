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
				<h2>New User Registration</h2>
				<p>Please enter your details below.</p>
				<p class="required">All fields are required.</p>
			</div>
			<div class="container">
				<?php
					if (isset($message)) {
						echo $message;
					}
				?>
				<form action="/acme/accounts/" method="post">
				<div class="row" >
					<div class="col-25">
						<label for="clientFirstname">First Name</label>
					</div>
					<div class="col-75">
						<input type="text" id="clientFirstname" name="clientFirstname" placeholder="Mahonri" required 
							<?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> >
					</div>
				 </div>
				<div class="row">
					<div class="col-25">
						<label for="clientLastname">Last Name</label>
					</div>
					<div class="col-75">
						<input type="text" id="clientLastname" name="clientLastname" placeholder="Moriancumr" required
							<?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> >
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="clientEmail">Email Address</label>
					</div>
					<div class="col-75">
						<input type="email" id="clientEmail" name="clientEmail" placeholder="youremail@something.com" required
							<?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> >
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="clientPassword">Password</label>
					</div>
					<div class="col-75">
						<input type="password" id="clientPassword" name="clientPassword" placeholder="Password" 
							required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
					</div>
				</div>
				<div class="row">
					<div class="col-30"></div>
					<div class="col-60">
						<span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="verifyPassword"> Verify Password</label>
					</div>
					<div class="col-75">
						<input type="password" id="verifyPassword" name="verifyPassword" placeholder="Password" 
							required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
					</div>
				</div>
				<div class="row">
					<input type="submit" name="submit" value="Register">
					<!-- Add the action name - value pair -->
					<input type="hidden" name="action" value="register">
				</div>
				</form>
			</div>
			<div class="formtext">
				<h4>Already Registered? <a href="../accounts/index.php?action=login">Click here to login.</a></h4>
			</div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
