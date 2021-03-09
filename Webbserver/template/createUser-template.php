<?php
$str="";
	if (isset($_GET['username'])) {
		$usr=$_GET['username'];
		$str="Användarnamnet $usr upptaget";
	}
	elseif(isset($_GET['email'])) {
		$ma=$_GET['email'];
		$str="Mailadressen $ma är upptagen";
	}
	if(!empty($_POST['fname'])&& !empty($_POST['ename'] )&& !empty( $_POST['mail'] )&& !empty($_POST ['adress']) && !empty( $_POST ['zip']) && !empty ($_POST ['ort']) && !empty ( $_POST ['nummer']) && !empty ($_POST ['aname']) && !empty ($_POST ['password'])) 
	{
		$firstname = filter_input(INPUT_POST,'fname', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$surname = filter_input(INPUT_POST,'ename', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$email = filter_input(INPUT_POST,'mail', FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW);
		$adress = filter_input(INPUT_POST,'adress', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$zip = filter_input(INPUT_POST,'zip', FILTER_SANITIZE_NUMBER_INT);
		$city =  filter_input(INPUT_POST,'ort', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$phone = filter_input(INPUT_POST,'nummer', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$username = filter_input(INPUT_POST,'aname', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$password = password_hash($password, PASSWORD_DEFAULT);
		
			
		require "../includes/connect.php";
			
		$sql="SELECT * FROM users WHERE username = ? OR email = ?";
		$res=$dbh->prepare($sql);
		$res->bind_param("ss",$username, $email);
		$res->execute();
		$result=$res->get_result();
		$row=$result->fetch_assoc();
		
		if($row !== NULL)
		{
			if($row['username']=== $username) {
				header("location:createUser.php?username=$username");
			}
			elseif($row['email'] === $email) {
				header("location;createUser.php?email=$email");
			}
		}
		else
		{
			$status = 1;
			$sql = "INSERT INTO users(username, email, password, status) VALUE (?,?,?,?)";
			$res=$dbh->prepare($sql);
			$res->bind_param("sssi",$username, $email, $password, $status);
			$res->execute();
			
			$sql = "INSERT INTO customers(username, firstname, surname, adress, zip, city, phone) VALUE (?,?,?,?,?,?,?)";
			$res=$dbh->prepare($sql);
			$res->bind_param("ssssiss",$username, $firstname, $surname, $adress, $zip, $city, $phone);
			$res->execute();
			$str="Användaren tillagd";
		}
	}
	else
	{
		$str.=<<<FORM
		<form action="createUser.php" method="post">
            <p><label for="fnamn">Förnamn:</label>
            <input type="text" id="fname" name="fname"></p>
			<p><label for="enamn">Efternamn:</label>
			<input type="text" id="ename" name="ename"></p>
			<p><label for="mail">Epost:</label>
			<input type="email" id="mail" name="mail"></p>
			<p><label for="adress">Adress:</label>
			<input type="text" id="adress" name="adress"></p>
			<p><label for="zip">Postnummer:</label>
			<input type="text" id="zip" name="zip"></p>
			<p><label for="ort">Postort:</label>
			<input type="text" id="ort" name="ort"></p>
			<p><label for="nummer">Telefon:</label>
			<input type="text" id="nummer" name="nummer"></p>
			<p><label for="anamn">Användarnamn:</label>
            <input type="text" id="aname" name="aname"></p>
            <p><label for="pwd">Lösenord:</label>
            <input type="password" id="pwd" name="password"></p>
            <p>
            <input type="submit" value="Skapa användare">
            </p>
        </form>
FORM;
	}
?>

<!DOCTYPE html>

<html lang="sv">

  <head>
     <meta charset="utf-8">
     <title>Logga in</title>
		 <link rel="stylesheet" href="css/stilmall.css">
	</head>
  <body id="login">
    <div id="wrapper">
     	<header><!--Sidhuvud-->
            <h1>Min onlinebutik - Logga in</h1>
      </header>
      
      <?php
		require "masthead.php";
		require "menu.php";
		?>
		
			<main> <!--Huvudinnehåll-->
				<section>
					<?php 
						echo "$str"; 
					?>
				</section>
			</main>
    </div>
    <?php	
		require "footer.php";
	?>

	</body>
</html>