            <div class='flexheader'>
                <img class="logo" src="/acme/images/site/logo.gif" alt="Standard ACME logo"/>
                <div class="account">

					<?php 
						if(!empty($_SESSION)) {

							if($_SESSION['loggedin']) {
								echo "<div class='accountchild'><p><a href='/acme/accounts/index.php?action=admin'>Welcome, " . $_SESSION['clientData']['clientFirstname'] . "!</a></p></div>"; 
								echo '<div class="accountchild"><a href="/acme/accounts/index.php?action=logout"><p>Logout</p></a></div>';
							} else {
								echo '<div class="accountchild"><a href="/acme/accounts/index.php?action=login"><p class="accountchild">My Account</p></a></div>';
								echo '<div class="accountchild"><a href="/acme/accounts/index.php?action=login"><img src="/acme/images/site/account.gif" alt ="My Account"></a></div>';
							}
						} else {
							echo '<div class="accountchild"><a href="/acme/accounts/index.php?action=login"><p class="accountchild">My Account</p></a></div>';
							echo '<div class="accountchild"><a href="/acme/accounts/index.php?action=login"><img src="/acme/images/site/account.gif" alt ="My Account"></a></div>';
							
						
						}

					?>
                </div>
				<nav>
					<?php echo $navList;?>
				</nav>
            </div>
            