<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../app.css">
  <title>Contacts</title>
  <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
  <style>
    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }

    .spinner {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 40px;
      height: 40px;
      border: 8px solid #f3f3f3;
      border-top: 8px solid #3498db;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    body {
      background-color: black;
      overflow: hidden;
    }

    #error,
    #success {
      position: fixed;
      top: -30px;
      left: 0;
      right: 0;
      padding: 20px;
      height: 20px;
      color: #fff;
      text-align: center;
      z-index: 9999;
    }
  </style>
</head>

<body>
  <div class="overlay">
    <div class="spinner"></div>
  </div>

  <div id="test">
    <navi>
      <div class="heading1">
        <h4>AutoLegal</h4>
      </div>
      <ul class="nav-linker">
        <li><a class="nav-link" href="../Index.html">Home</a></li>
        <li><a class="nav-link" href="newfile.html">New&nbspFile</a></li>
        <li><a class="nav-link active" href="correspondence.html">Correspondence</a></li>
        <li><a class="nav-link" href="pleadings.html">Pleadings</a></li>
        <li><a class="nav-link" href="contactshome.html">Contacts</a></li>
        <li><a class="nav-link" href="dropdownlegislation.php">Legislation</a></li>
        <li><a class="nav-link" href="edit.php">Edit</a></li>
        <li><a class="nav-link" id="plus" href="extras.html">+</a></li>
      </ul>
    </navi>

    <?php
    if (isset($_GET['error'])) {
      echo '<div id="error">' . $_GET['error'] . '</div>';
    }

    if (isset($_GET['success'])) {
      echo '<div id="success">' . $_GET['success'] . '</div>';
    }
    ?>

    <form action="./fetch3.php" id="myForm" method="post">
      <label for="heading" class="searchheading">Create a letter:</label>
      <div class="searchlable">
        <label for="cname">Reference number:</label>
      </div>
      <div class="col-75">
        <input type="text" class="input4" id="reference" style="text-transform:capitalize" name="reference" value="" autofocus="on" required autocomplete="off">
      </div>
      <div><br><br><br><br><br><br>
        <input type="submit" tabindex="2" class="inputcreate" value="Create ❯">
      </div>
      <div>
        <a class="btnsearch" tabindex="1" href="../../frontend2/Pages/correspondence.html">❮&nbsp&nbspBack</a>
      </div>
  </div>
  <img src="../Documents/hex.png" class="hexagons" alt="Outline of three hexagons">
  <img src="../Documents/hex2.png" class="hexagons2" alt="Outline of two hexagons">
  <script>
    /*document.querySelector("#myForm").addEventListener("submit", function(event) {
  event.preventDefault();
  document.querySelector(".overlay").style.display = "block";
  // simulate form processing
  setTimeout(function() {
    document.querySelector(".overlay").style.display = "none";
    // re-submit the form
    document.querySelector("#myForm").submit();
  }, 400);
});*/
    setTimeout(function() {
      document.querySelector('#error').style.display = 'none';
      document.querySelector('#success').style.display = 'none';
    }, 2000);
  </script>


</body>

</html>