<!DOCTYPE html>
<html lang="sv">
  <head>
     <meta charset="utf-8">
     <title>Produkter</title>
		 <link rel="stylesheet" href="css/stilmall.css">
	</head>
  <body id="sida3">
    <div id="wrapper">
    <?php
		require "masthead.php";
		require "menu.php";
		require "varor.php";	
	?>	
		<main> <!--Huvudinnehåll-->
			<section id="content">
				<h2>Varor</h2>
			<?php
				while($row=$result->fetch_assoc()) {
					echo "<tr><td>";
					echo $row["name"];
					echo "</td><td>";
					echo $row["description"];
					echo "</td><td>";
					echo "<img src='";
					echo $row["picture"];
					echo "'></td><td>";
					echo $row["price"];
					echo "</td></tr>";
				}	
			?>
			</section>
		</main>
		<aside id="aside">
			<p>News</p>
		</aside>
		</div>
		<!--Egen fil -->
		<?php
			require "footer.php";
		?>
  </body>
</html>