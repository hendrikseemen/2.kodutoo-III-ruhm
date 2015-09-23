
<?php
	
	// LOGIN.PHP
	
	// loon andmebaasi ühenduse
	require_once("../config.php");
	$database = "if15_hendrik7";
	$mysqli = new mysqli($servername, $username, $password, $database);
	
	// muutujad errorite jaoks
	$name_error = "";
	$email_error = "";
	$password_error = "";
	$create_password_error = "";
	$create_email_error = "";
	
	//muutujad andmebaasi väärtuste jaoks
	
	$name = "";
	$email = "";
	$username = "";
	$fullname ="";
	$create_email="";
	
	//kontrollime, et keegi vajutas input nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// LOGI SISSE
		
		if (isset($_POST["login"])) {
			echo "vajutas logi sisse";
			//kontrollin, et e-post ei ole tühi
			if (empty($_POST["email"])) {
				$email_error = "See väli on kohustuslik";
				
			}else{
				$email = test_input($_POST["email"]);
			}
				
			//kontrollin, et parool ei ole tühi
			if (empty($_POST["password"])) {
				$password_error = "See väli on kohustuslik";
			} else {
				$password = test_input($_POST["password"]);				
			}
			
			
			
		}
		
		// LOO KASUTAJA
		
		elseif (isset($_POST["create"])) //registration field errors
		{
			echo "vajutas sisesta nuppu";
			
			if (empty($_POST["username"])) {
				$name_error = "See väli on kohustuslik";	
			} else {
				$username = test_input($_POST["username"]);
			}
			
			
			
			
			if (empty($_POST["fullname"])) {
				$name_error = "See väli on kohustuslik";	
			} else {
				$fullname = test_input($_POST["full"]);
			}
			
			
			
			
			
			if (empty($_POST["create_email"])) {
				$create_email_error = "See väli on kohustuslik";
				
			}else{
				
				$create_email = test_input($_POST["create_email"]);
			}
			
			
			
			if (empty($_POST["create_password"])) {
				$create_password_error = "See väli on kohustuslik";
			
				
			}else{
				if(strlen($_POST["create_password"]) <8) {
					
					$create_password_error = "Peab olema vähemalt 8 tähemärki pikk";
				
				}
				
			}
			
			if ($name_error == ""){
				echo "salvestasin andmebaasi ".$name;
			}
		}
		
	}	
	
	function test_input($data) {
		// võtab ära tühikud, enterid, tabid
		$data = trim($data);
		//tagurpidi kaldkriipsud
		$data = stripslashes($data);
		//teeb html'i tekstiks
		$data = htmlspecialchars($data);
		return $data;
	}
	
		//Paneme ühenduse kinni
		$mysqli->close();
	
?>
<?php
	$page_title = "Kasutaja leht";
	$page_file_name = "login.php"
?>	

<?php require_once("../header.php"); ?>
<html>
<head>
	<title>Kasutaja leht</title>
</head>
<body>
	<FONT FACE="arial">
	
	<h2>Logi sisse</h2>
	
	<form action="login.php" method="post">
		<input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>"> <?php echo $email_error; ?> <br><br>
		<input name="password" type="password" placeholder="Parool"> <?php echo $password_error; ?> <br><br>
		<input type="submit" name="login" value="Logi sisse">
	</form>	
		
	<h2>Loo kasutaja</h2>
	
	<form action="login.php" method="post">
		<input name="fullname" type="text" placeholder="Täisnimi" value="<?php echo $fullname; ?>"> <?php echo $name_error; ?> <br><br>
		<input name="username" type="name" placeholder="Kasutajanimi" value="<?php echo $username; ?>"> <?php echo $name_error; ?> <br><br>
		<input name="create_email" type="email" placeholder="E-post" value="<?php echo $create_email; ?>"> <?php echo $create_email_error; ?> <br><br>
		<input name="create_password" type="password" placeholder="Parool"> <?php echo $create_password_error; ?> <br><br>
		<input name="create" type="submit" value="Sisesta">
	</form>	
	
	</FONT>
	
</body>

</html>
<?php require_once("../footer.php"); ?>