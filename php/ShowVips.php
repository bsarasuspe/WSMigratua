<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h3>Ikusi VIP erabiltzaileak</h3><br>
	<?php
        $curl = curl_init();
        $url = "http://localhost/WSMIG/WSMigratua/rest/VipUsers/";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($curl);
        echo $str; 
	?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>