<?php
    if (isset($eposta)){
        $soapclient = new SoapClient('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl');
        $result = $soapclient->egiaztatuE($eposta);
        if ($result == "EZ"){
            return 'Ez dago WS ikasgaian matrikulatuta';
        }else{
            return '';
        }
    }
?>