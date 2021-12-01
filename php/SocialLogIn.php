<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <?php include 'DbConfig.php'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h2>Login soziala</h2>
		  <?php
	require_once 'GoogleApi/vendor/autoload.php';
	 
	// init configuration
	$clientID = '1042483473840-hnj6bb5p31vrv2as48q3jh8uu24dibp3.apps.googleusercontent.com';
	$clientSecret = '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';
	$redirectUri = 'http://localhost/WSMIG/WSMigratua/php/SocialLogin.php';
	  
	// create Client Request to access Google API
	$client = new Google_Client();
	$client->setClientId($clientID);
	$client->setClientSecret($clientSecret);
	$client->setRedirectUri($redirectUri);
	$client->addScope("email");
	$client->addScope("profile");
	 
	// authenticate code from Google OAuth Flow
	if (isset($_GET['code'])) {
	  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	  $client->setAccessToken($token['access_token']);
	  
	  // get profile info
	  $google_oauth = new Google_Service_Oauth2($client);
	  $google_account_info = $google_oauth->userinfo->get();
	  $email =  $google_account_info->email;
	  $name =  $google_account_info->name;

		if (!empty($email)){
			try {
				$dsn = "mysql:host=localhost;dbname=$db";
				$dbh = new PDO($dsn, $erabiltzailea, $gakoa);
			} catch (PDOException $e){
				echo $e->getMessage();
			}

			$stmt = $dbh->prepare("SELECT eposta, pasahitza, irudia_dir, mota FROM Erabiltzaileak WHERE eposta = ? AND blokeatuta = ?"); 

			$eposta = $email;
			$blokeatuta = 0;
			$stmt->bindParam(1, $eposta);
			$stmt->bindParam(2, $blokeatuta);

			$stmt->setFetchMode(PDO::FETCH_ASSOC); 

			$stmt->execute();

			if (($tabladatuak = $stmt->fetch()) != null) {
				include 'IncreaseGlobalCounter.php';
				$_SESSION["kautotua"]= "BAI";
				$_SESSION["eposta"] = $tabladatuak["eposta"];
				$_SESSION["irudia"] = $tabladatuak["irudia_dir"];
				$_SESSION["mota"] = $tabladatuak["mota"];
				echo '<script> alert("Logeatu egin zara, '.$tabladatuak["eposta"].'") </script>';
				if($_SESSION["mota"] == 1){
					header("location: HandlingQuizesAjax.php");
				}else if($_SESSION["mota"] == 2){
					header("location: Layout.php");
				}else{
					header("location: Layout.php");
				}
			} else {
				echo '<br><p style="color: red">Erabiltzailea ez da existitzen.</p>';
			}
		}

                //$ema = $nireSQLI->query("SELECT eposta, pasahitza, irudia_dir, mota FROM Erabiltzaileak WHERE eposta = '".$_POST["eposta"]."' AND blokeatuta = 0");
	 
	  // now you can use this profile info to create account in your website and make user logged in.
	} else {
	  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
	}
	?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
