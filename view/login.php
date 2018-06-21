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
				<h2>Login</h2>
				<p>Please enter your email address and password.</p>
			</div>
			<div class="container">
                <?php
                if (isset($_SESSION['message'])) {
					echo $_SESSION['message'];
					$_SESSION['message'] = '';
				}
                ?>
				<form action="/acme/accounts/index.php" method="post">
					<div class="row">
						<div class="col-25">
							<label for="clientEmail">Email Address</label>
						</div>
						<div class="col-75">
							<input type="email" id="clientEmail" name="clientEmail" placeholder="youremail@something.com" required>
						</div>
					</div>
					<div class="row">
						<div class="col-25">
							<label for="clientPassword">Password</label>
						</div>
						<div class="col-75">
							<input type="password" id="clientPassword" name="clientPassword" placeholder="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
						</div>
					</div>
					<div class="row">
						<div class="col-30"></div>
						<div class="col-60">
							<span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
						</div>
					</div>
					<div class="row">
						<input type="submit" value="Submit">
						<input type="hidden" name="action" value="doLogin">
					</div>
				</form>
			</div>
			<div class="formtext">
				<h4>New user? <a href="../accounts/index.php?action=registration">Click here to register.</a></h4>
			</div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
