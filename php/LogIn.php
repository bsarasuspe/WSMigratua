<!DOCTYPE html>
<html>
<head> 

    <?php include '../html/Head.html'?>
    <?php include 'DbConfig.php'?>
</head>
<body>

    <?php include '../php/Menus.php' ?>
    <?php
        if (isset($_SESSION["kautotua"]) && $_SESSION["kautotua"] == "BAI") {
            echo "<script> window.location.href = 'Layout.php';</script>";
            exit();
        }
    ?>
    <section class="main" id="s1">
    <h2>Login</h2><br>
        <div>
            <form id="loginF" name="loginF" method="post">
                <!-- Eposta -->
                <label for="eposta">Eposta (*):</label>
                <input type="text" id="eposta" name="eposta"><br>

                <!-- Pasahitza -->
                <label for="pasahitza">Pasahitza (*):</label>
                <input type="password" id="pasahitza" name="pasahitza"><br>
                <br>
                
                <!-- Galdera igorri -->
                <input type="submit" name="submit" id="submit" value="Logeatu"><br>
            </form>
            <?php
            
            if (!empty($_POST)){
                $datuak = $_POST;
                try {
                    $dsn = "mysql:host=localhost;dbname=$db";
                    $dbh = new PDO($dsn, $erabiltzailea, $gakoa);
                    } catch (PDOException $e){
                    echo $e->getMessage();
                }
            
                /*global $zerbitzaria, $erabiltzailea, $gakoa, $db;
                $nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

                if($nireSQLI->connect_error) {
                    die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
                }*/

                $stmt = $dbh->prepare("SELECT eposta, pasahitza, irudia_dir, mota FROM erabiltzaileak WHERE eposta = ? AND blokeatuta = ?"); 

                $eposta = $_POST["eposta"];
                $blokeatuta = 0;
                $stmt->bindParam(1, $eposta);
                $stmt->bindParam(2, $blokeatuta);

                $stmt->setFetchMode(PDO::FETCH_ASSOC); 

                $stmt->execute();

                //$ema = $nireSQLI->query("SELECT eposta, pasahitza, irudia_dir, mota FROM Erabiltzaileak WHERE eposta = '".$_POST["eposta"]."' AND blokeatuta = 0");

                if (($tabladatuak = $stmt->fetch()) != null) {
                    if ($datuak["eposta"] == $tabladatuak["eposta"] && hash_equals($tabladatuak["pasahitza"], crypt($datuak["pasahitza"], $tabladatuak["pasahitza"]))) {
                        include 'IncreaseGlobalCounter.php';
                        $_SESSION["kautotua"]= "BAI";
                        $_SESSION["eposta"] = $tabladatuak["eposta"];
                        $_SESSION["irudia"] = $tabladatuak["irudia_dir"];
                        $_SESSION["mota"] = $tabladatuak["mota"];
                        $_SESSION["gaiak_erantzunda"] = array();
                        echo '<script> alert("Logeatu egin zara, '.$tabladatuak["eposta"].'") </script>';
                        if($_SESSION["mota"] == 1){
                            header("location: HandlingQuizesAjax.php");
                        }else if($_SESSION["mota"] == 2){
                            header("location: Layout.php");
                        }else{
                            header("location: Layout.php");
                        }
                    } else {
                        echo '<br><p style="color: red"> Zure erabiltzailea edo pasahitza ez dira zuzenak. </p>';
                    }
                } else {
                    echo '<br><p style="color: red"> Erabiltzailea ez da existitzen.</p>';
                }

            }
            ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
