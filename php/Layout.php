<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h2>Quiz: galderen jokoa</h2>
		<br><br>
      <h3>Top 10 quizers - Global ranking</h3>
		<br>
      	<?php
        $curl = curl_init();
        $url = "https://sw.ikasten.io/~bsarasua001/rest/VipUsers/top/10";
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
