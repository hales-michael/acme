<?php

$catList = "<select name='categoryId' id='categoryId'>";
$catList .= "<option disabled selected value>-- Please choose a category --</option>";
foreach ($categories as $category) {
	    $catList .= "<option value=".$category['categoryId'];
		if(isset($categoryId)) {
			if($category['categoryId'] === $categoryId) {
				$catList .= ' selected ';
			}
		}

		$catList .=">".$category['categoryName']."</option>";
    }

$catList .= '</select>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <title><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?> | ACME: Your one stop shop for all things Roadrunner-Murdery </title>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/head.php'; ?>

</head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/header.php'; ?>
        </header>
        <main>
			<div class="formtext">
				<h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h1>
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
						<label for="categoryId">Category</label>
					</div>
					<div class="col-75">
						<?php echo $catList; ?>
					</div>
				 </div>
				<div class="row">
					<div class="col-25">
						<label for="invName">Product Name</label>
					</div>
					<div class="col-75">
                        <input type="text" id="invName" name="invName" required <?php if(isset($invName)) {echo "value='$invName'";} elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; } ?> >
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invDescription">Product Description</label>
					</div>
					<div class="col-75">
                        <input type="text" id="invDescription" name="invDescription" required <?php if(isset($invDescription)) {echo "value='$invDescription'";} ?> />
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invImage">Product Image (path to image)</label>
					</div>
					<div class="col-75">
                        <input type="text" id="invImage" name="invImage" value="/acme/images/products/no-image.png" required <?php if(isset($invImage)) {echo "value='$invImage'";} ?> />
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invThumbnail">Product Thumbnail (path to thumbnail)</label>
					</div>
					<div class="col-75">
                        <input type="text" id="invThumbnail" name="invThumbnail" value="/acme/images/products/no-image.png" required <?php if(isset($invThumbnail)) {echo "value='$invThumbnail'";} ?> />
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invPrice">Product Price</label>
					</div>
					<div class="col-75">
                        <input type="number" step="0.01" min=0 id="invPrice" name="invPrice" required <?php if(isset($invPrice)) {echo "value='$invPrice'";} ?> >
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invStock">Amount in Stock</label>
					</div>
					<div class="col-75">
                        <input type="number" step=1 min=0 id="invStock" name="invStock" required <?php if(isset($invStock)) {echo "value='$invStock'";} ?> />
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invSize">Shipping Size (W x H x L in cubic inches)</label>
					</div>
					<div class="col-75">
                        <input type="number" step=1 min=0 id="invSize" name="invSize" required <?php if(isset($invSize)) {echo "value='$invSize'";} ?> />
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invWeight">Weight (lbs.)</label>
					</div>
					<div class="col-75">
                        <input type="number" step=1 min=0 id="invWeight" name="invWeight" required <?php if(isset($invWeight)) {echo "value='$invWeight'";} ?> />
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invLocation">Location (city name)</label>
					</div>
					<div class="col-75">
                        <input type="text" id="invLocation" name="invLocation" required <?php if(isset($invLocation)) {echo "value='$invLocation'";} ?> />
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invVendor">Vendor Name</label>
					</div>
					<div class="col-75">
                        <input type="text" id="invVendor" name="invVendor" required <?php if(isset($invVendor)) {echo "value='$invVendor'";} ?> />
					</div>
				 </div>
				 <div class="row">
					<div class="col-25">
						<label for="invStyle">Primary Material</label>
					</div>
					<div class="col-75">
                        <input type="text" id="invStyle" name="invStyle" required <?php if(isset($invStyle)) {echo "value='$invStyle'";} ?> />
					</div>
				 </div>
				<div class="row">
                    <input type="submit" name="submit" value="Update Product" />
					<!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateProd" />
				</div>
				</form>
			</div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '../acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
