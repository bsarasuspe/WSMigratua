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
      if (isset($_GET['eposta'])){
        echo '<div style="margin:auto;text-align:left;width:252px;">
          <form action="" method="post">
                <div class="form-group">
                <b>'.$_GET['eposta'].'</b> eposta duen erabiltzailearentzat pasahitza berrezartzen ari zara:
                </div>  <br>
                <div class="form-group">
                <label for="code">Kodea: </label><br>
                <input type="code" style="width:252px; margin-bottom:5px;" name="code" class="form-control">
                </div>  
                <div class="form-group">
                <label for="exampleInputEmail1">Pasahitza berria: </label><br>
                <input type="password" style="width:252px; margin-bottom:5px;" name="password" class="form-control">
                </div>                
                <div class="form-group">
                <label for="exampleInputEmail1">Errepikatu pasahitza: </label><br>
                <input type="password" style="width:252px;" name="cpassword" class="form-control">
                </div><br>
                <center><input type="submit" name="new-password" class="btn btn-primary" value="Bidali"></center>
            </form>
      </div>';
      }?>
      
        <?php

        include "DbConfig.php";

        global $zerbitzaria, $erabiltzailea, $gakoa, $db;
        $nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

        error_reporting(0);
        if(isset($_POST['password']) && $_POST['code'])
        {
            $sql = "SELECT * FROM erabiltzaileak WHERE eposta = '$_GET[eposta]' AND code ='$_POST[code]'";
            $data = $nireSQLI->query($sql);
            if (($data->num_rows) > 0){    
                if($_POST['password'] == $_POST['cpassword']){
                    if(strlen($_POST['password'])>=8){
                        $eposta = $_GET['eposta'];
                        $code = $_POST['code'];
                        $password = crypt($_POST['password']);
                        $sql = "UPDATE erabiltzaileak SET pasahitza='" . $password . "', code='" . NULL . "' WHERE eposta='" . $eposta . "'";
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
            }else{
                echo '<br><p style="color:red">Kodea ez da zuzena.</p>';
            }

            
        }
        ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>