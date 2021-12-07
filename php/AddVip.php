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
      $ch = curl_init();
      $eposta = $_POST['eposta'];
      curl_setopt($ch, CURLOPT_URL, "https://sw.ikasten.io/~bsarasua001/rest/VipUsers/");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, true);
      $data = array(
        'eposta'=> $eposta,
      );
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
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
