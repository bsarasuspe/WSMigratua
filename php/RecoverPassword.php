<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h2>Pasahitza berrezarri</h2><br>
	  <form action="" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Eposta: </label>
                  <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <br>
                <input type="submit" name="password-reset-token" class="btn btn-primary" value="Bidali">
              </form>
              <br>
              <?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['password-reset-token']) && $_POST['email'])
{
    include "DbConfig.php";

    global $zerbitzaria, $erabiltzailea, $gakoa, $db;
    $nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
     
    $eposta = $_POST['email'];
 
    $result = mysqli_query($nireSQLI,"SELECT * FROM Erabiltzaileak WHERE eposta='" . $eposta . "'");
 
    $row= mysqli_fetch_array($result);
 
  if($row)
  {
     
    $token = md5($eposta).rand(10,9999);
 
    $expFormat = mktime(
    date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
    );
 
    $expDate = date("Y-m-d H:i:s",$expFormat);
 
    $update = mysqli_query($nireSQLI,"UPDATE Erabiltzaileak set token='" . $token . "' ,expDate='" . $expDate . "' WHERE eposta='" . $eposta . "'");
 
    $link = "<a href='localhost/WSMigratua/php/ResetPassword.php?key=".$eposta."&token=".$token."'>aldatu pasahitza</a>";
 
    $mail = new PHPMailer();
    
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "swbsarasua@gmail.com";
    // GMAIL password
    $mail->Password = "Ikastensw1#";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='swbsarasua@gmail.com';
    $mail->FromName='Quiz Jokoa';
    $mail->AddAddress($eposta);
    $mail->Subject = 'Aldatu pasahitza';
    $mail->IsHTML(true);
    $mail->Body = 'Pasahitza aldatzea eskatu duzu! Egin klik link honetan pasahitza aldatzeko: '.$link.'';
    if($mail->Send())
    {
      echo "<p style='color:green'>Begiratu zure eposta eta egin klik bertara bidali den link-an.</p>";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }else{
    echo "<p style='color:red'>Eposta honekin ez zaude erregistratuta.</p>";
  }
}
?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>