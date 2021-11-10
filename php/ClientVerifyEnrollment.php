<?php
    if (isset($_POST['eposta'])){
        $eposta = $_POST['eposta'];
        $soapclient = new SoapClient('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl');
        $result = $soapclient->egiaztatuE($eposta);
        if ($result == "EZ"){
            return 'Ez dago WS ikasgaian matrikulatuta';
        }else{
            return '';
        }
    }
?>