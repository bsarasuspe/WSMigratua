<div id='page-wrap'>
<header class='main' id='h1'>
    <?php
    $parametroak = "";
    if (isset($_GET['eposta'])) {
        $parametroak = "?eposta=".$_GET['eposta'];
        $parametroak = $parametroak."&irudia=".$_GET['irudia'];
    }
 
    if (isset($_GET['eposta'])) {
        echo '<span class="right"><a href="LogOut.php'.$parametroak.'">Logout</a></span> &nbsp;';
        echo $_GET['eposta'].'&nbsp;';

        if (isset($_GET['irudia']) && file_exists($_GET['irudia'])) {
            $irudia = file_get_contents($_GET['irudia']);
            echo '<img src="data:image/*;base64,' . base64_encode($irudia) . '" height=50 width=50"/>';
        } else {
            echo '<img src="../images/default_erabiltzailea.png" height=50 width=50"/>';
        }
    } else {
        echo '<span class="right"><a href="SignUp.php">Erregistratu</a></span> &nbsp;';
        echo '<span class="right"><a href="LogIn.php">Login</a></span> &nbsp;';
        echo 'Anonimoa &nbsp;';
        echo '<img src="../images/erabiltzaile_anonimoa.png" height=50 width=50"/>';
    }
    ?>
</header>

<nav class='main' id='n1' role='navigation'>
    <?php
    if (isset($_GET['eposta'])) {
        $parametroak = "?eposta=".$_GET['eposta'];
        $parametroak = $parametroak."&irudia=".$_GET['irudia'];
        $parametroak = $parametroak."&mota=".$_GET['mota'];
    }

    echo '<span><a href="Layout.php'.$parametroak.'">Hasiera</a></span>';
    if (isset($_GET['eposta'])) {
        echo '<span><a href="QuestionFormWithImage.php'.$parametroak.'">Galderak gehitu</a></span>';
        echo '<span><a href="HandlingQuizesAjax.php'.$parametroak.'">Galderak gehitu AJAX</a></span>';
        echo '<span><a href="ShowQuestionsWithImage.php'.$parametroak.'">Galderak ikusi</a></span>';
        echo '<span><a href="ShowXmlQuestions.php'.$parametroak.'">Galderak (XML)</a></span>';
        echo '<span><a href="ShowJsonQuestions.php'.$parametroak.'">Galderak (JSON)</a></span>';
    }
    echo '<span><a href="Credits.php'.$parametroak.'">Kredituak</a></span>';
    if (isset($_GET['mota'])){
        $mota = $_GET['mota'];
        if ($mota == '2'){
            echo '<span><a href="IsVip.php'.$parametroak.'">VIPa da?</a></span>';
            echo '<span><a href="AddVip.php'.$parametroak.'">Gehitu VIPa</a></span>';
            echo '<span><a href="DeleteVip.php'.$parametroak.'">Ezabatu VIPa</a></span>';
            echo '<span><a href="ShowVips.php'.$parametroak.'">Ikusi VIPak</a></span>';
        }
    }
    ?>
</nav>
