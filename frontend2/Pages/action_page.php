<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../app.css" />
    <title>Correspondence</title>
</head>
The recipient's name is: <?php echo $_POST["contactpersonname"]; ?><br><br>
Their email address is: <?php echo $_POST["theiremailaddress"]; ?><br><br>
Their reference number is: <?php echo $_POST["receipientreferencenumber"]; ?><br><br>
Our reference number is: <?php echo $_POST["ourreferencenumber"]; ?><br><br>
The contact person is: <?php echo $_POST["contactperson"]; ?><br><br>
The subject line is: <?php echo $_POST["subjectline"]; ?><br><br>
The end paragraph is: <?php echo $_POST["eparagraph"]; ?><br><br>
The author of the letter is: <?php echo $_POST["author"]; ?><br><br>
<div>
    <a href="/frontend2/Pages/newfile.html"><button class="btn2" onclick="">Back</button></a>
</div>

</html>