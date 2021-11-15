<!DOCTYPE html>
<html>
<script>

    <?php
        if (isset($_GET['eposta'])) {
            $eposta = $_GET['eposta'];
            include 'DecreaseGlobalCounter.php';
            echo "alert('Mila esker zure bisitagatik. Laster arte: $eposta');";
        }
    ?>
    window.location.replace("Layout.php");
</script>
 </html>