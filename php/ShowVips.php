<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <?php
        if (($_SESSION["kautotua"] != "BAI") || ($_SESSION["mota"] != 2)) {
          echo "<script> window.location.href = 'Layout.php';</script>";
            exit();
        }
    ?>
  <section class="main" id="s1">
    <div>

      <h3>Ikusi VIP erabiltzaileak</h3><br>
	<?php
        $curl = curl_init();
        $url = "https://sw.ikasten.io/~bsarasua001/rest/VipUsers/";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($curl);
        echo $str; 
        curl_close($curl);
	?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>