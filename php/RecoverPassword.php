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
 
    $code = mt_Rand(100000,999999); 
 
    $update = mysqli_query($nireSQLI,"UPDATE Erabiltzaileak SET code='" . $code . "' WHERE eposta='" . $eposta . "'");
 
    $link = "<a href='localhost/WSMIG/WSMigratua/php/ResetPassword.php'></a>";
 
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
    $mail->Body = '<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Reset Password Email Template</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;">Pasahitza berrezartzea eskatu duzu</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            Ezin dizugu zure pasahitz zaharra bidali, baina berrezarri dezakezu. Egin klik beheko botoiean eta pasahitza berria jarri honako kode hau erabilita: <b>'.$code.'</b>
                                        </p>
                                        <a href="localhost/WSMIG/WSMigratua/php/ResetPassword.php?eposta='.$eposta.'"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Pasahitza berrezarri</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>';
    if($mail->Send())
    {
      echo "<p style='color:green'>Begiratu zure eposta eta jarraitu argibideak.</p>";
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