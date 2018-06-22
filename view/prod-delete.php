<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?> | ACME: Your one stop shop for all things Roadrunner-Murdery </title>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/head.php'; ?>

</head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/header.php'; ?>
        </header>
        <main>
			<div class="formtext">
				<h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h1>
				</div>
			<div class="container">
				<?php
					if (isset($message)) {
						echo $message;
					}
                ?>
				<p>Confirm Product Deletion. The delete is permanent.</p>
				<form action="/acme/products/index.php" method="post">
				<div class="row">
					<div class="col-25">
						<label for="invName">Product Name</label>
					</div>
					<div class="col-75">
                        <input type="text" id="invName" name="invName" readonly <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; } ?> >
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invDescription">Product Description</label>
					</div>
					<div class="col-75">
                        <input type="text" id="invDescription" name="invDescription" readonly <?php if(isset($prodInfo['invDescription'])) {echo "value='$prodInfo[invDescription]'"; } ?> >
					</div>
				 </div>
				<div class="row">
                    <input type="submit" name="submit" value="Delete Product" />
					<!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="deleteProd" />
					<input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">
				</div>
				</form>
			</div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
