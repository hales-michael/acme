            <div class='flexheader'>
                <img class="logo" src="/acme/images/site/logo.gif" alt="Standard ACME logo"/>
                <div class="account">

					<?php 
						if(empty($_SESSION['loggedin'])) {
							$_SESSION['loggedin'] = FALSE;
						}
							
						if($_SESSION['loggedin']) {
							echo "<div class='accountchild'><p>Welcome, " . $_SESSION['clientData']['clientFirstname'] . "!</p></div>"; 
							echo '<div class="accountchild"><a href="/acme/accounts/index.php?action=logout"><p>Logout</p></a></div>';
						} else {
							echo '<div class="accountchild"><a href="/acme/accounts/index.php?action=login"><p class="accountchild">My Account</p></a></div>';
							echo '<div class="accountchild"><a href="/acme/accounts/index.php?action=login"><img src="/acme/images/site/account.gif" alt ="My Account"></a></div>';
						}


					?>
                </div>
				<nav>
					<?php echo $navList;?>
			        <!-- <ul>
						<li><a href='#'>Home</a></li>
						<li><a href='#'>Cannon</a></li>
						<li><a href='#'>Explosive</a></li>
						<li><a href='#'>Misc</a></li>
						<li><a href='#'>Rocket</a></li>
						<li><a href='#'>Trap</a></li>
					</ul>
					-->
				</nav>
            </div>
            