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
	  <form action="password-reset-token.php" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Eposta: </label>
                  <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <br>
                <input type="submit" name="password-reset-token" class="btn btn-primary" value="Bidali">
              </form>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
