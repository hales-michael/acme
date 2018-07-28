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
            <h1>Welcome to Acme!</h1>
            <div class="rocket">
            <img id="rocketfeature" src="/acme/images/site/rocketfeature.jpg" alt="Rocket Feature."/>
                <ul>
                    <li><h2>Acme Rocket</h2></li>
                    <li>Quick lighting fuse</li>
                    <li>NHTSA approved seat belts</li>
                    <li>Mobile launch stand included</li>
                    <li>
                         <a href="/acme/products/index.php?action=detail&invId=1">
                              <img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif" />
                         </a></li>
				</ul>
            </div>
            <div class="contentwrapper">

                <div class="recipes">
					<h3>Featured Recipes</h3>
                    <div class="recipescolumn">
                        <div class="foodimage">
                            <img src="/acme/images/recipes/bbqsand.jpg" alt="Pulled Roadrunner BBQ Sandwich"/>
							<a href="#">Pulled Roadrunner BBQ</a>
                        </div>
                        <div class="foodimage">
                            <img src="/acme/images/recipes/soup.jpg" alt="Roadrunner Soup"/>
							<a href="#">Roadrunner Soup</a>
                        </div>
                        <div class="foodimage">
                            <img src="/acme/images/recipes/potpie.jpg" alt="Roadrunner Pot Pie"/>
							<a href="#">Roadrunner Pot Pie</a>
                        </div>
                        <div class="foodimage">
                            <img src="/acme/images/recipes/taco.jpg" alt="Roadrunner Taco"/>
							<a href="#">Roadrunner Soup</a>
                        </div>
                    </div>                        
                </div>

				<!--<div class="grid-container">
					<div class="grid-item">
						<img src="images/recipes/bbqsand.jpg" alt="Pulled Roadrunner BBQ Sandwich" />
						<a href="#">Pulled Roadrunner BBQ</a>
					</div>
					<div class="grid-item">
						<img src="images/recipes/soup.jpg" alt="Roadrunner Soup" />
						<a href="#">Roadrunner Soup</a>
					</div>
					<div class="grid-item">
						<img src="images/recipes/potpie.jpg" alt="Roadrunner Pot Pie" />
						<a href="#">Roadrunner Pot Pie</a>
					</div>
					<div class="grid-item">
						<img src="images/recipes/taco.jpg" alt="Roadrunner Taco" />
						<a href="#">Roadrunner Soup</a>
					</div>
				</div> -->

					<div class="reviews">
						<h3>Acme Rocket Reviews</h3>
						<ul>
							<li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
							<li>"That thing was fast!" (4/5)</li>
							<li>"Talk about fast delivery." (5/5)</li>
							<li>"I didn't even have to pull the meat apart." (4.5/5)</li>
							<li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
						</ul>
					</div>
				</div>
            
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
