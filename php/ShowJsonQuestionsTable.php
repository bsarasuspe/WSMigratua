<!DOCTYPE html>
<html>
<head>
    <?php include '../html/Head.html'?>
</head>
<body style="background-color:white;">
        <table style="width:700px" border="1px" bgcolor="white">
            <thead>
            <th>Egilea</th>
            <th>Enuntziatua</th>
            <th>Erantzun zuzena</th>
            </thead>
            <tbody>
            <?php
            $json_raw = file_get_contents("../json/Questions.json");
            $json = json_decode($json_raw);
            foreach ($json->assessmentItems as $galdetegi){
                $eposta = $galdetegi->author;
                $enuntziatua = $galdetegi->itemBody->p;
                $erantzun_z = $galdetegi->correctResponse->response;

                echo '<tr>';
                echo "<td>" . $eposta . "</td>";
                echo "<td>" . $enuntziatua . "</td>";
                echo "<td>" . $erantzun_z . "</td>";
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
</body>
</html>