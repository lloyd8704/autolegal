<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6">
  <style>
    table {
      width: 100%;
    }

    footer {
      text-align: center;
      font-style: italic;
    }

    td {
      padding: 10px;
    }

    td:first-child {
      border-right: 1px solid black;
    }

    table {
      border-collapse: collapse;
      border: 1px solid black;
    }

    th,
    td {
      border: 1px solid black;
      padding: 10px;
    }

    td:first-child {
      border-right: none;
    }

    table {
      border-collapse: collapse;
      border: 1px solid black;
    }

    th,
    td {
      border: 1px solid black;
      padding: 10px;
    }

    td:first-child {
      border-right: none;
    }
  </style>



</head>

<body>

  <img src="example.png">

  <h1>Invoice</h1>

  <p>Name: {{ name }}</p>

  <table>
    <tbody>
      <tr>
        <td>Row 1, Column 1</td>
        <td colspan="4">Row 1, Column 2</td>

      </tr>
      <tr>
        <td>Row 2, Column 1</td>
        <td colspan="4">Row 2, Column 2</td>

      </tr>
      <tr>
        <td>Row 3, Column 1</td>
        <td colspan="4">Row 3, Column 2</td>

      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
      <tr>
        <th rowspan="2">Column 1</th>
        <th>Column 2</th>
        <th>Column 3</th>
        <th>Column 4</th>
        <th>Column 5</th>
      </tr>
      <tr>
        <th>Column 2</th>
        <th>Column 3</th>
        <th>Column 4</th>
        <th>Column 5</th>
      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
      <tr>
        <td>Row 4, Column 1</td>
        <td colspan="4">Row 4, Column 2</td>

      </tr>
    </tbody>
  </table>

  <footer>
    This is an example
  </footer>

</body>

</html>