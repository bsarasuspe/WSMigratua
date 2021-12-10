<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="../js/AddLikeAjax.js"></script>
  <script src="../js/AddDislikeAjax.js"></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
      <?php
        if(isset($_POST["erantzuna"])){
          \array_splice($_SESSION["q_id"], 0, 1);
          array_push($_SESSION["q_erantzunda_id"], $_SESSION["current_q_id"]);
          $_SESSION["q_erantzunda"] = $_SESSION["q_erantzunda"] + 1;
          if(strcmp($_POST["erantzuna"],$_SESSION["eZuzen"]) !== 0){
            $_SESSION["q_gaizki"] = $_SESSION["q_gaizki"] + 1;
            echo '<img src="../images/fallado.png" width="100">
                  <br>
                  <h2>Ez duzu asmatu!</h2>';
          }else{
            $_SESSION["q_egoki"] = $_SESSION["q_egoki"] + 1;
            echo '<img src="../images/acertado.png" width="100">
                  <br>
                  <h2>Asmatu duzu!</h2>';
          }
          echo "<br><h3>Gustatu zaizu galdera?</h3><br>
          <div id='bozkatu'><img src='../images/like.png' width='30px' onclick='AddLikeAjax($_SESSION[current_q_id])'> <img src='../images/dislike.png' width='30px' onclick='AddDislikeAjax($_SESSION[current_q_id])'><br></div>";
        }
      ?>
      
      <br>

      <?php
        if(sizeof($_SESSION["q_id"]) > 0){
          echo "<form id='jarraitu' name='jarraitu' method='post' action='Question.php'>
      <button type='submit' id='jarraitu'>Jarraitu jolasten</button>
    </form>
    <br>
    <form id='amaitu' name='amaitu' method='post' action='EndGame.php'>
      <button type='submit' id='jolastu'>Irten jokotik</button>
    </form>";
        }else{
          echo "<h4>Ez daude galdera gehiago!</h4><form id='amaitu' name='amaitu' method='post' action='FinalResult.php'><br>
      <button type='submit' id='jolastu'>Ikusi emaitza</button>
    </form>";
        }
      ?>
        

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
