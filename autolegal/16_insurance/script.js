// Create a <script> element
var scriptElement = document.createElement('script');

// Set the src attribute to the Font Awesome URL
scriptElement.src = "https://kit.fontawesome.com/ee76321fd5.js";

// Set the crossorigin attribute
scriptElement.crossOrigin = "anonymous";

// Append the <script> element to the <head> section of your HTML document
document.head.appendChild(scriptElement);

$(document).ready(function () {
    // Delay before showing the tooltip
    var delay = 600;
    var timeoutId;

    // Function to show the tooltip
    function showTooltip() {
        $('.tooltip').fadeIn();
    }

    // Function to hide the tooltip
    function hideTooltip() {
        $('.tooltip').fadeOut();
    }

    // Event listener for mouse enter on the sign out button
    $('.sign_out').mouseenter(function () {
        timeoutId = setTimeout(showTooltip, delay);
    });

    // Event listener for mouse leave on the sign out button
    $('.sign_out').mouseleave(function () {
        clearTimeout(timeoutId);
        hideTooltip();
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

    document.addEventListener('keydown', checkCapsLock);

    checkCapsLock({}); // call checkCapsLock once to check caps lock at page load
});

$(document).ready(function () {
    $("#login-form").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize(); // Serialize the form data
        $.ajax({
            url: "login.php",
            type: "POST",
            data: formData,
            success: function (response) {
                if (response == "success") {
                    // Redirect to the home page
                    var redirect_url = "../16_insurance/index.php";
                    window.location.href = redirect_url;

                } else {
                    // Display an error message
                    $("#message").html("*Incorrect username or password*");
                    // Hide the message after 2 seconds
                    setTimeout(function () {
                        $("#message").html("");
                    }, 2000);
                }
            }
        });
    });




    $("#togglePassword").click(function () {
        const passwordInput = $("#password");
        const toggleIcon = $(this);
        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            toggleIcon.removeClass("fa-eye");
            toggleIcon.addClass("fa-eye-slash");
        } else {
            passwordInput.attr("type", "password");
            toggleIcon.removeClass("fa-eye-slash");
            toggleIcon.addClass("fa-eye");
        }
    });

    $("#togglePassword1").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var current_password = $("#current_password");
        if (current_password.attr("type") === "password") {
            current_password.attr("type", "text");
        } else {
            current_password.attr("type", "password");
        }
        var new_password = $("#new_password");
        if (new_password.attr("type") === "password") {
            new_password.attr("type", "text");
        } else {
            new_password.attr("type", "password");
        }
        var confirm_new_password = $("#confirm_new_password");
        if (confirm_new_password.attr("type") === "password") {
            confirm_new_password.attr("type", "text");
        } else {
            confirm_new_password.attr("type", "password");

        }
    });

});
$(document).ready(function () {
    $("#login-form-2").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize(); // Serialize the form data
        $.ajax({
            url: "login_autolegal.php",
            type: "POST",
            data: formData,
            success: function (response) {
                if (response == "success") {
                    // Redirect to the home page
                    var redirect_url = "../1_Home/Index.php";
                    window.location.href = redirect_url;

                } else {
                    // Display an error message
                    $("#message").html("*Incorrect username or password*");
                    // Hide the message after 2 seconds
                    setTimeout(function () {
                        $("#message").html("");
                    }, 2000);
                }
            }
        });
    });
})