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
            <input type="hidden" name="email" value="<?php echo $email;?>">
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
        if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
        {
            $emailId = $_POST['email'];
            $token = $_POST['reset_link_token'];
            $password = md5($_POST['password']);
            $query = mysqli_query($nireSQLI,"SELECT * FROM Erabiltzaileak WHERE token='".$token."' and eposta='".$email."';");
            $row = mysqli_num_rows($query);
            if($row){
                mysqli_query($nireSQLI,"UPDATE Erabiltzaileak SET pasahitza='" . $password . "', token='" . NULL . "', expDate='" . NULL . "' WHERE eposta='" . $emailId . "'");
                echo '<br><p style="color:green">Zure pasahitza ongi berrezarri da.</p>';
            }else{
                echo '<br><p style="color:red">Zerbait gaizki joan da, saiatu berriro.</p>';
            }
        }
        ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>