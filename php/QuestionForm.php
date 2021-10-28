<!DOCTYPE html>
<html>
<head>
    <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- <script src="../js/ValidateFieldsQuestionJQ.js"></script> -->
    <script src="../js/ValidateFieldsQuestionJQ.js"></script>
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
                    echo '<input type="text" id="frmeposta" name="frmeposta" value="'.$eposta.'" disabled="disabled">';
                } else {
                    echo '<input type="text" id="frmeposta" name="frmeposta" placeholder="EHU eposta">';
                }
                ?>
                <br>

                <!-- Galdera testua -->
                <label for="frmgalderatxt">Galderaren testua (*):</label>
                <input type="text" id="frmgalderatxt" name="frmgalderatxt"><br>

                <!-- Erantzun zuzena -->
                <label for="frmerantzunzuzena">Erantzun zuzena (*):</label>
                <input type="text" id="frmerantzunzuzena" name="frmerantzunzuzena"><br>

                <!-- Erantzun okerra 1 -->
                <label for="frmerantzunokerra1">Erantzun okerra1 (*):</label>
                <input type="text" id="frmerantzunokerra1" name="frmerantzunokerra1"><br>

                <!-- Erantzun okerra 2 -->
                <label for="frmerantzunokerra2">Erantzun okerra2 (*):</label>
                <input type="text" id="frmerantzunokerra2" name="frmerantzunokerra2"><br>

                <!-- Erantzun okerra 3 -->
                <label for="frmerantzunokerra3">Erantzun okerra3 (*):</label>
                <input type="text" id="frmerantzunokerra3" name="frmerantzunokerra3"><br>

                <!-- Zailtasuna -->
                <label>Zailtasuna (*):</label>
                <input type="radio" id="frmrdbtxikia" name="frmzailtasuna" value="1">
                <label for="frmrdbtxikia">Txikia</label>

                <input type="radio" id="frmrdbertaina" name="frmzailtasuna" value="2">
                <label for="frmrdbertaina">Ertaina</label>

                <input type="radio" id="frmrdbhandia" name="frmzailtasuna" value="3">
                <label for="frmrdbhandia">Handia</label><br>

                <!-- Gai arloa -->
                <label for="frmgaiarloa">Gaia (*):</label>
                <input type="text" id="frmgaiarloa" name="frmgaiarloa"><br>

                <!-- Hustu -->
                <input type="reset" name="reset" id="reset"  value="Hustu">

                <!-- Galdera igorri -->
                <input type="submit" name="submit" id="submit" value="Galdera igorri" >
            </form>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
