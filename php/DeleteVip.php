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
      <h3>Ezabatu VIP erabiltzailea</h3><br>
      <form id="form" name="form" method="post">
                <!-- Eposta -->
                <label for="eposta">Eposta (*):</label>
                <input type="text" id="eposta" name="eposta"><br><br>

                <!-- Eposta igorri -->
                <input type="submit" name="submit" id="submit" value="VIPa ezabatu"><br>
            </form><br>

      <?php
      if (isset($_POST['eposta'])){
        $ch = curl_init();
        $eposta = $_POST['eposta'];
        $url = "https://sw.ikasten.io/~T52/rest/VipUsers/".$eposta;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $output = curl_exec($ch);
        echo $output;
        curl_close($ch);
        }
      ?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
