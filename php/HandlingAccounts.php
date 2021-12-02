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
      <table style="width:700px" border="1px" bgcolor="#f4f4f4">
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

                $ema = $nireSQLI->query("SELECT * FROM erabiltzaileak");

                for ($x = 0; $x < $ema->num_rows; $x++){
                    $ema->data_seek($x);
                    $datuak = $ema->fetch_assoc();
                    if($datuak['eposta'] != $_SESSION['eposta']){
                        echo "<tr>";
                        echo "<td>" . $datuak['eposta'] . "</td>";
                        echo "<td>" . $datuak['pasahitza'] . "</td>";
                        echo "<td>" . $datuak['mota'] . "</td>";
                        if(isset($datuak['irudia_dir']) && file_exists($datuak['irudia_dir'])){
                          echo "<td> <img src='../images/$datuak[irudia_dir]' height=50 width=50/></td>";
                        }else{
                          echo "<td> <img src='../images/default_erabiltzailea.png' height=50 width=50/></td>";
                        }
                        if(isset($datuak['blokeatuta']) && $datuak['blokeatuta'] == 0){
                          echo "<td> <center><form id='blokeatu' name='blokeatu' method='post' action='ChangeUserState.php'>
                          <input id='eposta' name='eposta' type='hidden' value='$datuak[eposta]'>
                          <input id='blokeatuta' name='blokeatuta' type='hidden' value='false'>
                          <button type='submit' id='permutatu')'>OFF</button>
                          </form></center> </td>";
                        }else if(isset($datuak['blokeatuta'])){
                          echo "<td> <center><form id='desblokeatu' name='desblokeatu' method='post' action='ChangeUserState.php'>
                          <input id='eposta' name='eposta' type='hidden' value='$datuak[eposta]'>
                          <input id='blokeatuta' name='blokeatuta' type='hidden' value='true'>
                          <button type='submit' id='permutatu')'>ON</button>
                          </form></center> </td>";
                        }
                        echo "<td> <center><form id='borratu' name='borratu' method='post' action='RemoveUser.php'>
                        <input id='eposta' name='eposta' type='hidden' value='$datuak[eposta]'>
                        <button type='submit' id='ezabatu')'>Ezabatu</button>
                        </form></center>  </td>";
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
