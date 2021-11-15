<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h3>Erabiltzaile bat VIPa den identifikatu</h3><br>
      <form id="form" name="form" method="post">
                <!-- Eposta -->
                <label for="eposta">Eposta (*):</label>
                <input type="text" id="eposta" name="eposta"><br><br>

                <!-- Eposta igorri -->
                <input type="submit" name="submit" id="submit" value="VIPa da?"><br>
            </form><br>

<?php
    if (isset($_POST['eposta'])){
        $curl = curl_init();
        $eposta = $_POST['eposta'];
        $url = "https://sw.ikasten.io/~T52/rest/VipUsers/".$eposta;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($curl);
        echo $str; 
        curl_close($curl);
    }
?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
