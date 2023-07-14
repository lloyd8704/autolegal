<?php

require_once 'Pages/phpoffice/vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

function generateDocx()
{
    $templateProcessor = new TemplateProcessor('C:\Users\Lloyd\Desktop\PROJECT\playground\frontend2\Pages\phpoffice\vendor\template.docx');
    $num_fields = 2; //default number of fields

    if (isset($_POST['submit'])) {
        if (isset($_POST['num_fields'])) {
            $num_fields = intval($_POST['num_fields']);
        }

        for ($i = 1; $i <= $num_fields; $i++) {
            $input_field_name = 'input' . $i;
            if (isset($_POST[$input_field_name])) {
                $templateProcessor->setValue('input' . $i, $_POST[$input_field_name]);
            }
        }

        $templateProcessor->saveAs('C:\Users\Lloyd\Desktop\PROJECT\playground\frontend2\Pages\phpoffice\vendor\generated_document.docx');
    }
?>

    <form action="" method="post">
        <label for="num_fields">Number of fields:</label>
        <input type="text" name="num_fields" value="<?php echo $num_fields; ?>">
        <br><br>
        <?php
        for ($i = 1; $i <= $num_fields; $i++) {
            echo '<label for="input' . $i . '">Input ' . $i . ':</label>';
            echo '<input type="text" name="input' . $i . '">';
            echo '<br><br>';
        }
        ?>
        <input type="submit" name="submit" value="Generate Document">
    </form>
<?php
}

generateDocx();

?>