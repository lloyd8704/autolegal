<?php
echo "
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Orbitron' />
  <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
</head>
<body>
  <div id='container'>
      <div class='logo'>AI</div>
      <h1>AUTOMATED INSURANCE</h1>
      <div id='login-container'>
        <form id='login-form' method='post'>
          <!--<label for='username'>Username:</label>-->
          <input type='text' id='username' name='username' autocomplete='off' required placeholder='User Name'><br><br>
          <!--<label for='password'>Password:</label>-->
          <div id='password-container' style='position: relative;'>
            <input type='password' id='password' name='password' autocomplete='off' required placeholder='Password' onkeydown='checkCapsLock(event)'>
            <i class='fas fa-eye' id='togglePassword' style='position: absolute; right: 5px; top: 5px;'></i>
          </div>
          <br>
            <button type='submit'>Login</button>
            <a class='forgotpassword' href='../16_insurance/forgot_password_1.html'>Forgot Password?</a>
            <div id='capsLockWarning' class='capsLockWarning'>*Caps Lock is on</div> 
        </form>
      </div>
  </div>         
<div id='message'></div>
</body>
<style>

.capsLockWarning{
  display: none;
    position: relative;
    margin-top: -38%;
    margin-left: -147%;
    font-weight: bold;
}
/* Set the minimum height of the section to 50% of the viewport height */
section {
  min-height: 50vh;
}

/* On small screens, set the section height to 100% of the viewport height */
@media (max-width: 767px) {
  section {
    min-height: 100vh;
  }
}

a.forgotpassword {
  position: relative;
    color: #151A7B;
    margin-top: 3%;
    margin-left: 57%;
    text-decoration: none;
    display: inline-block;
   
}

#login-container {
/* border: 3px solid #ccc; */
border-radius: 4px;
margin: 0 auto;
width: 325px;
padding: 20px;
position: relative;
padding-right: 38px;
padding-top: 10px;
}

#login-form label {
display: inline-block;
width: 80px;
}

#login-form input {
width: 90%;
padding: 6px;
padding-left: 15px;
background-color: white;
border: 2px solid navy;
border-radius: 7px;
height: 35px;
font-size: 17px;
}

#message {
color: #ff3300;
font-size: 18px;
font-weight: bold;
text-align: center;
position: absolute;
left: 49%;
transform: translate(-50%, 50%);
width: 98%;
top: 38%;
}


#togglePassword {
font-size: 19px;
position: relative;
color: #151A7B;
margin-top: 3%;
margin-right: 4%;
text-decoration: none;
display: inline-block;
cursor: pointer;
}


#login-form button {
display: inline-block;
padding: 5px 10px;
background-color: #007bff;
color: #fff;
border: none;
text-decoration: none;
border-radius: 7px;
width: 97%;
height: 45px;
font-size: 20px;
cursor: pointer;
}

#login-form button:hover{
background-color: #0062cc;
}

body {
font-family: Arial, sans-serif;
background-color: #f0f0f0;
}

#container {
width: 520px;
margin: auto;
/*background-color: #fff;
border-radius: 5px;
box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);*/
padding: 30px;
text-align: center;
margin-top: 3%;
}

h1 {
font-size: 28px;
margin-bottom: 20px;
text-align: center;
font-family: Orbitron;
font-weight: bolder;
font-size: 28px;
margin-bottom: 20px;
text-align: center;
font-family: Orbitron;
font-weight: bolder;
font-size: 36px;
font-weight: bold;
color: #151A7B;
}

p {
font-size: 18px;
margin-bottom: 20px;
color: #333;
text-align: center;
}

.a {
display: block;
margin-top: 20px;
padding: 10px 20px;
background-color: #007bff;
color: #fff;
text-align: center;
text-decoration: none;
border-radius: 5px;
}

.a:hover {
background-color: #0062cc;
}

.copy-btn {
display: inline-block;
margin-left: 10px;
padding: 5px 10px;
background-color: #007bff;
color: #fff;
text-decoration: none;
border-radius: 5px;
cursor: pointer;
}

.copy-btn:hover {
background-color: #0062cc;
}

.copy-btn:after {
content: '\2714';
display: none;
}

.copied {
background-color: #2ecc71;
}

.copied:after {
display: inline-block;
}

.logo {
background-color: #151A7B;
box-shadow: 0 0 0 3px white, 0 0 0 6px #151A7B;
border-radius: 20px;
color: white;
cursor: default;
font-family: Orbitron;
font-size: 87px;
font-weight: bold;
height: 102px;
padding: 10px;
padding-top: 5px;
text-align: center;
text-decoration: wavy;
width: 111px;
}
.logo {
display: block;
margin: 0 auto;
}
</style>
 
 <script>
    $(document).ready(function() {
      $('#login-form').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize(); // Serialize the form data
        $.ajax({
          url: 'login.php',
          type: 'POST',
          data: formData,
          success: function(response) {
            if (response == 'success') {
              // Redirect to the home page
              var redirect_url = '<?php echo $redirect_url; ?>';
        window.location.href = redirect_url;
              
            } else {
              // Display an error message
              $('#message').html('*Incorrect username or password*');
              // Hide the message after 2 seconds
              setTimeout(function() {
                $('#message').html('');
              }, 2000);
            }
          }
        });
      });

      $('#togglePassword').click(function() {
        const passwordInput = $('#password');
        const toggleIcon = $(this);
        if (passwordInput.attr('type') === 'password') {
          passwordInput.attr('type', 'text');
          toggleIcon.removeClass('fa-eye');
          toggleIcon.addClass('fa-eye-slash');
        } else {
          passwordInput.attr('type', 'password');
          toggleIcon.removeClass('fa-eye-slash');
          toggleIcon.addClass('fa-eye');
        }
      });
    });
    function checkCapsLock(event) {
  var capsLockOn = false;
  event = event || window.event;

  if (event.getModifierState) {
    capsLockOn = event.getModifierState('CapsLock');
  } else {
    capsLockOn = (event.keyCode >= 65 && event.keyCode <= 90 && !event.shiftKey) || (event.keyCode >= 97 && event.keyCode <= 122 && event.shiftKey);
  }

  if (capsLockOn) {
    document.getElementById('capsLockWarning').style.display = 'block';
  } else {
    document.getElementById('capsLockWarning').style.display = 'none';
  }
}
      </script>
</body>
</html>";
