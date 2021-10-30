<!DOCTYPE html>
<html>
<head>
    <?php include '../html/Head.html'?>
    <?php include 'DbConfig.php'?>
</head>
<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div>
            <?php
            function galderaGehitu() {
                global $zerbitzaria, $erabiltzailea, $gakoa, $db;
                $nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

                if($nireSQLI->connect_error) {
                    return "<b style='color: red'>DB-ra konexio bat egitean errore bat egon da: ". $nireSQLI->connect_error."</b>
                            <button onclick='window.history.back()'>Berriro saiatu</button>";
                }

                if ($_SERVER['REQUEST_METHOD'] == 'GET') $aldagaiak = $_GET;
                else if ($_SERVER['REQUEST_METHOD'] == 'POST') $aldagaiak = $_POST;
                else die("Konekzioa egitean datuak ezin izan dira lortu");

                $sqlInsertQuestion = "INSERT INTO Questions(eposta, galdera, eZuzen, eOker1, eOker2, eOker3, zailtasuna, gaia) 
                VALUES ('$aldagaiak[frmeposta]', '$aldagaiak[frmgalderatxt]', '$aldagaiak[frmerantzunzuzena]', '$aldagaiak[frmerantzunokerra1]', '$aldagaiak[frmerantzunokerra2]', '$aldagaiak[frmerantzunokerra3]', '$aldagaiak[frmzailtasuna]', '$aldagaiak[frmgaiarloa]')";
                if (!$nireSQLI->query($sqlInsertQuestion)) {
                    return '<b style="color: red">Errorea: '.$nireSQLI->error."</b>
                            <button onclick='window.history.back()'>Berriro saiatu</button>";
                }

                return "<p>Galdera gehitu egin da:</p> <p><a href='ShowQuestions.php'>Galdera guztiak ikusi</a></p>";
            }

            echo "<p>".galderaGehitu()."</p>"
            ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
