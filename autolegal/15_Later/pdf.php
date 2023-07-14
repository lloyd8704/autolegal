<?php
require_once '../../vendor/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $html_template = file_get_contents('C:\Users\Lloyd\Desktop\TEST.htm');
    $html = str_replace('{name}', $name, $html_template);
    $html = str_replace('{email}', $email, $html);
    $html = str_replace('{message}', $message, $html);
    $image_path = '../11_Images/ACE - LOGO.png';
    $image_data = base64_encode(file_get_contents($image_path));
    $image_src = 'data:image/png;base64,' . $image_data;
    $html = str_replace('{image}', '<img src="' . $image_src . '">', $html);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream('contact-form.pdf');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Contact Form</title>
</head>

<body>
    <h1>Contact Form</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="message">Message:</label>
        <textarea name="message" required></textarea>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>

</html>