<?php
session_start();
$attorneys = $_POST['attorneys'];
require "../frontend2/Pages/database.php";

$_SESSION['reference'];
$ref = "1";

$test = $ref = "1";
$query = $pdo->prepare("SELECT * FROM pleadings WHERE reference = ?");
$query->execute([$test]);
$result = $query->rowCount();
if ($result > 0) {
    $insert = $_POST['attorneyone'];

    $sql = "UPDATE `pleadings` SET `attorneyone` = \'hello\' WHERE `pleadings`.`reference` = 1;";
}
$msg = "<span class='success'><br>Your file has been successfully created!</span>";
if ($_SESSION['attorneys'] == "1O") {
    if (empty($error)) {
        //$query = $pdo->prepare("INSERT INTO pleadings (attorneyone) VALUES(:attorneyone)");
        //$query->execute([
        //  'attorneyone' => $_POST['attorneyone'],
        $sql = "UPDATE `pleadings` SET `attorneyone` = \'here\' WHERE `pleadings`.`id` = 1;";

        //]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
?>
<div class="container test-center register">

    <?php if (isset($error)) {
        echo $error;
    } ?>
    <?php if (isset($msg)) {
        echo $msg;
    } ?>


</div>

</html>