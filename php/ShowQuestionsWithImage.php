<!DOCTYPE html>
<html>
<head>
    <?php include '../html/Head.html'?>
</head>
<body>
    <?php include '../php/Menus.php' ?>
    <?php
        if (($_SESSION["kautotua"] != "BAI") || ($_SESSION["mota"] == "3")) {
            echo "<script> window.location.href = 'Layout.php';</script>";
            exit();
        }
    ?>
    <section class="main" id="s1" style="display: flex">
        <div style="overflow-y: scroll; overflow-x: scroll">
            <table style="width:100%">
                <thead>
                    <th>Eposta</th>
                    <th>Galdera</th>
                    <th>Erantzun zuzena</th>
                    <th>Erantzun okerra (1)</th>
                    <th>Erantzun okerra (2)</th>
                    <th>Erantzun okerra (3)</th>
                    <th>Zailtasuna</th>
                    <th>Gaia</th>
                    <th>Irudia</th>
                </thead>
                <tbody>
                    <?php include 'DbConfig.php';
                    function taulaSortu() {
                        global $zerbitzaria, $erabiltzailea, $gakoa, $db;
                        $nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

                        if($nireSQLI->connect_error) {
                            die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
                        }

                        $ema = $nireSQLI->query("SELECT eposta, galdera, eZuzen, eOker1, eOker2, eOker3, zailtasuna, gaia, argazkia
                            FROM questions");

                        for ($x = 0; $x < $ema->num_rows; $x++){
                            $ema->data_seek($x);
                            $datuak = $ema->fetch_assoc();
                            echo "<tr>";
                            echo "<td>" . $datuak['eposta'] . "</td>";
                            echo "<td>" . $datuak['galdera'] . "</td>";
                            echo "<td>" . $datuak['eZuzen'] . "</td>";
                            echo "<td>" . $datuak['eOker1'] . "</td>";
                            echo "<td>" . $datuak['eOker2'] . "</td>";
                            echo "<td>" . $datuak['eOker3'] . "</td>";
                            echo "<td>" . $datuak['zailtasuna'] . "</td>";
                            echo "<td>" . $datuak['gaia'] . "</td>";
                            if ($datuak['argazkia'] != "") {
                                echo "<td>" . '<img src="data:image/*;base64,' . base64_encode($datuak['argazkia']) . '" height=75 width=75"/>' . "</td>";
                            } else {
                                echo "<td>" . '<img src="../images/default_argazkia.png" height=75 width=75"/>' . "</td>";
                            }

                            echo "</tr>";
                        }
                    }
                    taulaSortu();
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
