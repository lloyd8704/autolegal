<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Date Calculator</title>
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
</head>

<body>
    <div id="test">

        <body style="background-color: black">
            <navi>
                <div class="heading1">
                    <h4>AutoLegal</h4>
                </div>
                <ul class="nav-linker">
                    <li><a class="nav-link" href="../Index.html">Home</a></li>
                    <li><a class="nav-link" href="../Pages/newfile.html">New&nbspFile</a></li>
                    <li><a class="nav-link" href="../Pages/correspondence.html">Correspondence</a></li>
                    <li><a class="nav-link" href="../Pages/pleadings.html">Pleadings</a></li>
                    <li><a class="nav-link" href="../Pages/contactshome.html">Contacts</a></li>
                    <li><a class="nav-link" href="../Pages/dropdownlegislation.php">Legislation</a></li>
                    <li><a class="nav-link" href="../Pages/edit.php">Edit</a></li>
                    <li><a class="nav-link active" id="plus" href="../Pages/extras.html">+</a></li>
                </ul>
            </navi>
    </div>

    <style>
        #date,
        #result {
            border: 2px solid black
        }

        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 13px 3px;
            padding: 10px;
            background-color: whitesmoke;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 550px;
            margin: 0 auto;
            font-weight: bold;
            position: relative;
            top: 100px;
            padding-bottom: 20px;
            padding-top: 20px;
        }

        .container input[type="date"],
        .container input[type="text"] {
            grid-column: 1 / span 4;
            margin-bottom: 10px;
            position: relative;
            width: 160px;
            left: 180px;
            padding: 5px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            background-color: #fff;
            box-shadow: inset 0 1px 3px #ddd;
            text-align: center;
            font-family: "Montserrat", sans-serif;
            font-size: 19px;
            font-weight: bold;

        }

        .container input[type="date"] {
            cursor: text;
        }

        .center-label {
            grid-column: 2 / span 2;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Montserrat", sans-serif;
        }


        .container button {
            padding: 10px;
            font-weight: bold;
            font-size: 21px;
            height: 60px;
            border-radius: 5px;
            border: 2px solid white;
            color: white;
            background-color: black;
            box-shadow: 0 2px 4px #888;
            cursor: pointer;
            font-family: "Montserrat", sans-serif;
        }


        .container button:hover {
            background-color: white;
            color: black;
            border: 2px solid black;
        }

        container button:active {
            box-shadow: 0 1px 2px #888;
            transform: scale(0.95);
        }

        #result {
            grid-column: 2 / span;
            width: 240px;
            left: 155px;
        }

        .label-center {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            font-family: "Montserrat", sans-serif;
        }

        .center-label {
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 24px;
            font-family: "Montserrat", sans-serif;

        }
    </style>
    </head>

    <body>
        <div class="container">

            <label for="date" class="center-label">Select a date:</label>
            <input type="date" id="date">

            <button id="button-5">5 days</button>
            <button id="button-10">10 days</button>
            <button id="button-15">15 days</button>
            <button id="button-20">20 days</button>

            <label for="result" class="center-label"><br>Due date:</label>
            <input type="text" id="result" readonly>


            <script>
                const dateInput = document.getElementById("date");
                const currentDate = new Date().toISOString().slice(0, 10);
                dateInput.value = currentDate;
                const resultInput = document.getElementById("result");
                const button5 = document.getElementById("button-5");
                const button10 = document.getElementById("button-10");
                const button15 = document.getElementById("button-15");
                const button20 = document.getElementById("button-20");

                button5.addEventListener("click", function() {
                    calculateDays(5);
                });

                button10.addEventListener("click", function() {
                    calculateDays(10);
                });

                button15.addEventListener("click", function() {
                    calculateDays(15);
                });

                button20.addEventListener("click", function() {
                    calculateDays(20);
                });

                function calculateDays(days) {
                    const selectedDate = new Date(dateInput.value);
                    let endDate = addBusinessDays(selectedDate, days);
                    let formattedEndDate = formatDate(endDate, "EEEE, dd-MM-yyyy");

                    resultInput.value = formattedEndDate;
                }

                function addBusinessDays(date, days) {
                    let result = new Date(date.getTime());

                    while (days > 0) {
                        result = addDays(result, 1);

                        if (isBusinessDay(result)) {
                            days--;
                        }
                    }

                    return result;
                }

                function addDays(date, days) {
                    let result = new Date(date.getTime());
                    result.setDate(result.getDate() + days);
                    return result;
                }

                function isBusinessDay(date) {
                    const dayOfWeek = date.getDay();
                    return dayOfWeek !== 0 && dayOfWeek !== 6;
                }

                function formatDate(date, format) {
                    const day = date.getDate();
                    const month = date.getMonth() + 1;
                    const year = date.getFullYear();
                    const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    const dayOfWeek = daysOfWeek[date.getDay()];

                    format = format.replace("dd", String(day).padStart(2, "0"));
                    format = format.replace("d", day);
                    format = format.replace("MM", String(month).padStart(2, "0"));
                    format = format.replace("yyyy", year);
                    format = format.replace("EEEE", dayOfWeek);
                    format = format.replace("EEE", dayOfWeek.slice(0, 3));

                    return format;
                }
            </script>