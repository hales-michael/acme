<!DOCTYPE html>
<html lang='en'>
<head>
    <title>ACME: Your one stop shop for all things Roadrunner-Murdery </title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.imageThumb').click(function () {
                $('#itemMainImage').attr('src', $(this).attr('src').replace('-tn', ''));
            });
        });
    </script>

</head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
        <main>

		<?php echo $pd; ?>

        </main> 



        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
