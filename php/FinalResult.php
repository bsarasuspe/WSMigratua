<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <h2>Jokoa amaitu da!</h2>
    <img src="../images/quizlogo.png">
    <br>
    Hona hemen lortutako emaitza:<br><br>
    <?php
      echo "<p style='color:green;'>$_SESSION[q_egoki] galdera ongi erantzun dituzu.</p>
      <p style='color:red;'>$_SESSION[q_gaizki] galdera gaizki erantzun dituzu.</p><br>"
    ?>
    <form id='amaitu' name='amaitu' method='post' action='EndGame.php'>
      <button type='submit' id='jolastu'>Jolastu berriz</button>
    </form>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
