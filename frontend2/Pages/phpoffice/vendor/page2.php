<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Select a Pleading</title>
    <link rel="stylesheet" href="../../../app.css" />


    <?php
    session_start();
    $plaintiffs = $_POST['Plaintiffs'] . "P";
    $defendants = $_POST['Defendants'] . "D";
    $number = $plaintiffs . $defendants;
    $_SESSION['opponents'] = $number;
    if ($number == "PD") {
        echo "No items selected";
    } else if (
        $number == "1PD" or $number == "2PD" or $number == "3PD" or $number == "4PD"
        or $number == "5PD" or $number == "6PD"
    ) {
        echo "No number of Defendants selected";
    } else if (
        $number == "P1D" or $number == "P2D" or $number == "P3D" or $number == "P4D"
        or $number == "P5D" or $number == "P6D"
    ) {
        echo "No number of Plaintiffs selected";
    } else if ($number == "1P1D") {
        readfile("../../../generatorp.html");
    } else if ($number == "1P2D") {
        readfile("../../../generatorp.html");
    }
    //'<a href=page' . $number . '.php>Link</a>';

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