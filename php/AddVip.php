<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h3>Gehitu VIP erabiltzailea</h3><br>
      <form id="form" name="form" method="post">
                <!-- Eposta -->
                <label for="eposta">Eposta (*):</label>
                <input type="text" id="eposta" name="eposta"><br><br>

                <!-- Eposta igorri -->
                <input type="submit" name="submit" id="submit" value="VIPa bihurtu"><br>
            </form><br>

<?php
    if (isset($_POST['eposta'])){
        $curl = curl_init();
        $eposta = $_POST['eposta'];
        $url = "http://localhost/WSMIG/WSMigratua/rest/VipUsers/".$eposta;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($curl);
        echo $str; 
    }
?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
