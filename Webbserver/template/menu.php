<?php
	if(!isset($_SESSION['username'])) {
		echo<<<NAV
		<nav><!--Navigationsmeny-->
			<ul>	
				<li><a href="index.php">Start</a></li>
				<li><a href="products.php">Produkter</a></li>
				<li><a href="sida3.php">Varusida 2</a></li>
				<li><a href="login.php">Logga in</a></li>
			</ul>
		</nav>
NAV;
	}
	else{
		if($_SESSION['status']==1){
			echo<<<NAV
			<nav>
				<u1>
					<li><a href="index.php">Start</a></li>
					<li><a href="products.php">Produkter</a></li>
					<li><a href="sida3.php">Varusida 2</a></li>
					<li><a href="admin.php">Admin</a></li>
				</ul>
			</nav>
NAV;
	}
	elseif($_SESSION['status']==2){
			echo<<<NAV
			<nav>
				<u1>
					<li><a href="index.php">Start</a></li>
					<li><a href="products.php">Produkter</a></li>
					<li><a href="createProduct.php">Skapa Produkt</a></li>
					<li><a href="admin.php">Admin</a></li>
				</ul>
			</nav>
NAV;
		}
	}