<!DOCTYPE html>
<html lang='en'>
<head>
      <title><?php echo $type; ?> Products | ACME: Your one stop shop for all things Roadrunner-Murdery </title>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

</head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
        <main>
            <h1><?php echo $type; ?> Products</h1>
			<?php if(isset($message)){ echo $message; } ?>
			<?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>

        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
