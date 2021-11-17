<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <?php
        if (($_SESSION["kautotua"] != "BAI") || ($_SESSION["mota"] != 3)) {
            echo "<script> window.location.href = 'Layout.php';</script>";
            exit();
        }
    ?>
  <?php include 'DbConfig.php';?>
  <section class="main" id="s1">
    <div>

      <h2>Erabiltzaileak kudeatu</h2>
      <br>
        <center>
      <table style="width:700px" border="1px" bgcolor="white">
            <thead>
                <th>Eposta</th>
                <th>Gakoa</th>
                <th>Mota</th>
                <th>Irudia</th>
                <th>Permutatu</th>
                <th>Ezabatu</th>
            </thead>
            <tbody>
            <?php
                global $zerbitzaria, $erabiltzailea, $gakoa, $db;
                $nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

                if($nireSQLI->connect_error) {
                    die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
                }

                $ema = $nireSQLI->query("SELECT * FROM Erabiltzaileak");

                for ($x = 0; $x < $ema->num_rows; $x++){
                    $ema->data_seek($x);
                    $datuak = $ema->fetch_assoc();
                    if($datuak['eposta'] != $_SESSION['eposta']){
                        echo "<tr>";
                        echo "<td>" . $datuak['eposta'] . "</td>";
                        echo "<td>" . $datuak['pasahitza'] . "</td>";
                        echo "<td>" . $datuak['mota'] . "</td>";
                        echo "<td>" . $datuak['irudia_dir'] . "</td>";
                        echo "<td> <center><button id='permutatu'>ON</button></center> </td>";
                        echo "<td> <center><button id='ezabatu'>Ezabatu</button></center>  </td>";
                        echo "</tr>";
                    }
                }
            ?>
            </tbody>
        </table>
            </center>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
