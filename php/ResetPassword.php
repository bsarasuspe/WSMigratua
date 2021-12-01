<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h2>Pasahitza berrezarri</h2><br>
      <?php
        if($_GET['key'] && $_GET['token']){
        include "DbConfig.php";

        global $zerbitzaria, $erabiltzailea, $gakoa, $db;
        $nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

        $email = $_GET['key'];
        $token = $_GET['token'];

        $query = mysqli_query($nireSQLI,"SELECT * FROM Erabiltzaileak WHERE token='".$token."' and eposta='".$email."';");

        $curDate = date("Y-m-d H:i:s");
        if (mysqli_num_rows($query) > 0) {
        $row= mysqli_fetch_array($query);
        if($row['expDate'] >= $curDate){
            echo '<form action="" method="post">
            <input type="hidden" name="email" value="<?php echo $eposta;?>">
            <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
            <div class="form-group">
            <label for="exampleInputEmail1">Pasahitza berria: </label>
            <input type="password" name="password" class="form-control">
            </div>                
            <div class="form-group">
            <label for="exampleInputEmail1">Errepikatu pasahitza: </label>
            <input type="password" name="cpassword" class="form-control">
            </div><br>
            <input type="submit" name="new-password" class="btn btn-primary" value="Bidali">
            </form>';
        } else{
            echo '<p style="color:red">Pasahitza berrezartzeko link hau iraungita dago.</p>';
        }
        }else{
            echo '<p style="color:red">Pasahitza berrezartzeko tokena ez da zuzena.</p>';
        }
    }
        ?>

        <?php
        error_reporting(0);
        if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
        {
            if($_POST['password'] == $_POST['cpassword']){
                if(strlen($_POST['password'])>=8){
                    $eposta = $_GET['key'];
                    $token = $_POST['reset_link_token'];
                    $password = crypt($_POST['password']);
                    $sql = "UPDATE Erabiltzaileak SET pasahitza='" . $password . "', token='" . NULL . "' , expDate='" . NULL . "' WHERE eposta='" . $eposta . "'";
                    if (!$nireSQLI->query($sql)) {
                        $mezua = str_replace("'", "\'", $nireSQLI->error);
                        echo "<script>alert('Errorea datu-basean: $mezua')</script>";
                        return;
                    }
                    echo '<br><p style="color:green">Zure pasahitza ongi berrezarri da.</p>';
                }else{
                    echo '<br><p style="color:red">Pasahitzak 8 karaktere baino gehiago izan behar ditu.</p>';
                }
            }else{
                echo '<br><p style="color:red">Pasahitzak ez dira berdinak.</p>';
            }
            
        }
        ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>