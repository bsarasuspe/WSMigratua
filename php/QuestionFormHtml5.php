<!DOCTYPE html>
<html>
<head>
    <?php include '../html/Head.html'?>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div>
            <form id="galderenF" name="galderenF" action="AddQuestion.php">
                <!-- Eposta -->
                <label for="frmeposta">Eposta (*):</label>
                <?php
                if (isset($_GET['eposta'])) {
                    $eposta = $_GET['eposta'];
                    echo '<input type="text" id="frmeposta" name="frmeposta" value="'.$eposta.'" disabled="disabled" required>';
                } else {
                    echo '<input type="text" id="frmeposta" name="frmeposta"
                       pattern="^(([a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(eus|es))|([a-zA-Z]+\.[a-zA-Z]+@ehu\.(eus|es)|[a-zA-Z]+@ehu\.(eus|es)))$"
                       title="Eposta okerra" placeholder="EHU eposta" required>';
                }
                ?>
                <br>

                <!-- Galdderatxt -->
                <label for="frmgalderatxt">Galderaren testua (*):</label>
                <input type="text" id="frmgalderatxt" minlength="10" name="frmgalderatxt" required><br>

                <!-- Erantzun zuzena -->
                <label for="frmerantzunzuzena">Erantzun zuzena (*):</label>
                <input type="text" id="frmerantzunzuzena" name="frmerantzunzuzena" required><br>

                <!-- Erantzun okerra 1 -->
                <label for="frmerantzunokerra1">Erantzun okerra1 (*):</label>
                <input type="text" id="frmerantzunokerra1" name="frmerantzunokerra1" required><br>

                <!-- Erantzun okerra 2 -->
                <label for="frmerantzunokerra2">Erantzun okerra2 (*):</label>
                <input type="text" id="frmerantzunokerra2" name="frmerantzunokerra2" required><br>

                <!-- Erantzun okerra 3 -->
                <label for="frmerantzunokerra3">Erantzun okerra3 (*):</label>
                <input type="text" id="frmerantzunokerra3" name="frmerantzunokerra3" required><br>

                <!-- Zailtasuna -->
                <label>Zailtasuna (*):</label>
                <input type="radio" id="frmrdbtxikia" name="frmzailtasuna" value="1" required>
                <label for="frmrdbtxikia">Txikia</label>

                <input type="radio" id="frmrdbertaina" name="frmzailtasuna" value="2">
                <label for="frmrdbertaina">Ertaina</label>

                <input type="radio" id="frmrdbhandia" name="frmzailtasuna" value="3">
                <label for="frmrdbhandia">Handia</label><br>

                <!-- Gai arloa -->
                <label for="frmgaiarloa">Gaia (*):</label>
                <input type="text" id="frmgaiarloa" name="frmgaiarloa" required><br>

                <!-- Hustu -->
                <input type="reset" name="reset" id="reset"  value="Hustu">

                <!-- Galdera igorri -->
                <input type="submit" name="submit" id="submit" value="Galdera igorri">
            </form>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
