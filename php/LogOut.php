<!DOCTYPE html>
<html>
<script>
    <?php
        session_start();
        session_destroy();
        include 'DecreaseGlobalCounter.php';
        header("location: Layout.php");
    ?>
</script>
 </html>