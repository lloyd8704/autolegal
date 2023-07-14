<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend2/app.css">
    <title>Select a Pleading</title>
    <link rel="shortcut icon" type="image/x-icon" href="../frontend2/favicon.ico">
</head>
<div id="test">

    <body style="background-color: black">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="Index.html">Home</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/correspondence.html">Correspondence</a></li>
                <li><a class="nav-link active" href="../frontend2/Pages/pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/edit.php">Edit</a></li>
                <li><a class="nav-link" id="plus" href="../frontend2/Pages/extras.html">+</a></li>
            </ul>
        </navi>
        <br><br>
        <form action="../frontend2/hcpleadings2.php" method="post">
            <fieldset>
                <legend>
                    &nbspList of Pleadings&nbsp
                </legend><br><br><br>
                <label>Select a Pleading:</label>
                <input autocomplete="off" role="combobox" list="" id="input" name="pleadings" placeholder="Search... " required>
                <!-- Its important that you keep list attribute empty to hide the default dropdown icon and the browser's default datalist -->

                <datalist id="pleadings" role="listbox">
                    <option disabled> - A -</option>
                    <option value="Confirmatory Affidavit">Affidavit Confirmatory - Attorney</option>
                    <option value="Confirmatory Affidavit - Other">Affidavit Confirmatory - Other</option>
                    <option value="Opposing Affidavit">Affidavit Opposing</option>
                    <option value="Supplementary Affidavit">Affidavit Supplementary - Attorney</option>
                    <option value="Supplementary Affidavit - Other">Affidavit Supplementary - Other</option>
                    <option value="Rule 28 Amendment">Amendment - Rule 28</option>
                    <option value="Notice of Objection ito Rule 28 - Code P0">Amendment - Objection</option>
                    <option value="Application for Default Judgement - No Appearance">Application for Default Judgement - No Appearance</option>
                    <option value="Application for Default Judgement - No Plea">Application for Default Judgement - No Plea</option>
                    <option value="Application for Recission of Default Judgement">Application for Recission of Default Judgement</option>
                    <option value="Application for Recission of Default Judgement - Affidavit">Application for Recission of DJ - Affidavit</option>
                    <option value="Application for Revival of Superannuated Order">Application for Revival of Superannuated Order</option>
                    <option value="Application to Compel - Discovery">Application to Compel - Discovery</option>
                    <option value="Application to Compel - Affidavit - Discovery">Application to Compel - Affidavit - Discovery</option>
                    <option value="Application to Compel - General">Application to Compel - General</option>
                    <option value="Application to Dismiss">Application to Dismiss</option>
                    <option value="Application to Dismiss - Affidavit">Application to Dismiss - Affidavit</option>
                    <option value="Application - Long Form">Application - Long Form</option>
                    <option value="Appointment as Attorneys of Record">Appointment as Attorneys of Record</option>
                    <option disabled> - C -</option>
                    <option value="Chamberbook Application">Chamberbook Application</option>
                    <option value="Condonation Application">Condonation Application</option>
                    <option value="Condonation Application - Affidavit">Condonation Application - Affidavit</option>
                    <option value="Consequential Adjustment">Consequential Adjustment</option>
                    <option value="Consolidation Application">Consolidation Application</option>
                    <option value="Consolidation Application - Affidavit">Consolidation Application - Affidavit</option>
                    <option value="Compliance Certificate">Compliance Certificate</option>
                    <option value="Court Order - Application to Compel">Court Order - Application to Compel</option>
                    <option value="Court Order - Default Judgment">Court Order - Default Judgment</option>
                    <option value="Court Order - Rescinding Default Judgment">Court Order - Rescinding Default Judgment</option>
                    <option value="Court Order - Pre-Trial Conference">Court Order - Pre-Trial Conference</option>
                    <option disabled> - D -</option>
                    <option value="Damages Affidavit - Construction">Damages Affidavit - Construction</option>
                    <option value="Damages Affidavit - Vehicle">Damages Affidavit - Vehicle - Economical to Repair</option>
                    <option value="Damages Affidavit - Vehicle - Uneconomical">Damages Affidavit - Vehicle - Uneconomical to Repair</option>
                    <option value="Discovery Affidavit - Correspondence & Documents">Discovery Affidavit - Correspondence & Documents</option>
                    <option value="Discovery Affidavit - Documents Only">Discovery Affidavit - Documents Only</option>
                    <option disabled> - E -</option>
                    <option value="Expert Notice - Notice Only">Expert Notice - Notice Only</option>
                    <option value="Expert Notice - Notice & Summary">Expert Notice - Notice & Summary</option>
                    <option value="Expert Notice - Summary Only">Expert Notice - Summary Only</option>
                    <option disabled> - F -</option>
                    <option value="Filing Sheet">Filing Sheet</option>
                    <option value="Founding Affidavit">Founding Affidavit - Attorney</option>
                    <option value="Founding Affidavit - Other">Founding Affidavit - Other</option>
                    <option disabled> - I -</option>
                    <option value="Irregular Step Notice">Irregular Step Notice</option>
                    <option value="Irregular Step Notice - Non-compliance with Rules">Irregular Step Notice - Non-compliance with Rules</option>
                    <option disabled> - N -</option>
                    <option value="Notice of Bar - Code P0">Notice of Bar</option>
                    <option value="Notice of Change of Address">Notice of Change of Address</option>
                    <option value="Notice of Exception - Code P0">Notice of Exception</option>
                    <option value="Notice of Intention to Abide">Notice of Intention to Abide</option>
                    <option value="Notice of Intention to Defend">Notice of Intention to Defend</option>
                    <option value="Notice of Objection to Amendment - Subsitute Parties - Code P0">Notice of Objection to Amendment - Substituting Parties</option>
                    <option value="Notice of Objection to Photographs - Code P0">Notice of Objection to Photographs</option>
                    <option value="Notice of Removal - Trial Roll">Notice of Removal - Trial Roll</option>
                    <option value="Notice of Removal - Pre-trial Roll">Notice of Removal - Pre-trial Roll</option>
                    <option value="Notice of Setdown">Notice of Setdown</option>
                    <option value="Notice of Substitution - New Correspondents">Notice of Substitution - New Correspondents</option>
                    <option value="Notice of Withdrawal of Action - Matter Settled">Notice of Withdrawal of Action - Matter Settled</option>
                    <option value="Notice of Withdrawal of Action - Each Party to Bear Costs">Notice of Withdrawal of Action - Bear Own Costs</option>
                    <option value="Notice of Withdrawal of Pleading or Notice">Notice of Withdrawal of Pleading or Notice</option>
                    <option value="Notice of Withdrawal of Application">Notice of Withdrawal of Application</option>
                    <option value="Notice to Attend Medical Examination - Code P0">Notice to Attend Medical Examination</option>
                    <option value="Notice to Oppose - Application">Notice to Oppose - Application</option>
                    <option disabled> - P -</option>
                    <option value="Pretrial - First Pretrial for Plaintiff">Pre-trial - First Pre-trial for Plaintiff</option>
                    <option value="Pretrial - First Pretrial for Defendant">Pre-trial - First Pre-trial for Defendant</option>
                    <option value="Pretrial - Progress Report">Pre-trial - Progress Report</option>
                    <option disabled> - R -</option>
                    <option value="Request for Default Judgment - No Appearance - Code PA">Request for Default Judgment - No Appearances</option>
                    <option value="Request for Trial Particulars - Code P0">Request for Trial Particulars</option>
                    <option value="Reply to Request for Trial Particulars - Code P0">Reply to Request for Trial Particulars</option>
                    <option value="Rule 35 Notices - Code P0">Rule 35 Notices</option>
                    <option value="Rule 35(6)(a) - Notice to Produce">Rule 35(6)(a) - Notice to Produce</option>
                    <option value="Rule 35(6)(b) - Notice to Inspect">Rule 35(6)(b) - Notice to Inspect</option>
                    <option value="Rule 35(6)(b) - Notice to Inspect - Objection">Rule 35(6)(b) - Notice to Inspect - Objection</option>
                    <option value="Rule 35(3)&(6) Notices - Code P0">Rule 35(3) & (6) Notices - Request for Additional Docs</option>
                    <option value="Rule 35(12) & (14) Notices - Code P0">Rule 35(12) & (14) Notices</option>
                    <option value="Rule 35(15) Notice - Code P0">Rule 35(15) Notice - Call for Documents before Plea</option>
                    <option value="Rule 36(9)(a)">Rule 36(9)(a) - Notice Only</option>
                    <option value="Rule 36(9)(a) & (b)">Rule 36(9)(a) & (b) - Notice & Summary</option>
                    <option value="Rule 36(9)(b)">Rule 36(9)(b) - Summary Only</option>
                    <option value="Rule 36(10)">Rule 36(10) - Photographs</option>
                    <option disabled> - S -</option>
                    <option value="Settlement Agreement - Full and Final - Code A">Settlement Agreement - Full and Final</option>
                    <option value="Settlement Agreement - Including Costs - Code A">Settlement Agreement - Including Costs</option>
                    <option value="Settlement Agreement - Installments - Code A">Settlement Agreement - Installments</option>
                    <option value="Special Plea - Prescription">Special Plea - Prescription</option>
                    <option value="Special Plea - Misjoinder - Code P0">Special Plea - Misjoinder</option>
                    <option value="Subpoena - Female - Code P0">Subpoena - Female</option>
                    <option value="Subpoena - Male - Code P0">Subpoena - Male</option>
                    <option value="Subpoena Duces Tecum - Female - Code P0">Subpoena Duces Tecum - Female</option>
                    <option value="Subpoena Duces Tecum - Male - Code P0">Subpoena Duces Tecum - Male</option>
                    <option disabled> - W -</option>
                    <option value="Warrant of Execution - Code W0">Warrant of Execution</option>
                    <option value="Warrant of Execution - Code WI">Warrant of Execution - With Interest</option>
                    <option value="Withdrawal as Attorneys of Record">Withdrawal as Attorneys of Record</option>
                </datalist>

            </fieldset><br>

            <div><button class="inputdropdown" type="submit">Next</div>
        </form>
        <style>
            fieldset {
                position: relative;
                border: 2px solid white;
                width: 496px;
                border-radius: 5px;
                left: 457px;
                top: 15px;
            }

            legend {
                color: white;
                font-size: 28px;
                font-family: sans-serif;
            }

            label {
                color: white;
                font-size: 24px;
                font-family: sans-serif;
            }

            input {
                font-size: 18px;
                padding: 5px;
                height: 35px;
                width: 483px;
                border: 1px solid white;
                outline: none;
                border-radius: 5px;
                color: black;
                margin-left: -2px;

                /*   border-bottom: none; */
            }

            form:invalid button {
                opacity: 0.3;
                pointer-events: none;

            }

            input:hover {
                background-color: black;
                color: white;
                cursor: text;
                /*   border-bottom: none; */
            }


            .inputdropdown {
                background-color: black;
                color: white;
                font-size: 20px;
                font-weight: bold;
                padding: 0px 44px;
                border: none;
                border-radius: 4px;
                border: 2px solid white;
                cursor: pointer;
                position: relative;
                width: 148px;
                height: 45px;
                left: 962px;
                top: -48px;
            }

            .inputdropdown:hover {
                background-color: white;
                color: black;
                cursor: pointer
                    /*   border-bottom: none; */
            }

            datalist {
                position: absolute;
                background-color: black;
                border: 1px solid white;
                border-radius: 0 0 5px 5px;
                border-top: none;
                font-family: sans-serif;
                width: 480px;
                padding: 5px;
                max-height: 23rem;
                overflow-y: auto
            }

            option {
                background-color: black;
                padding: 4px;
                color: white;
                margin-bottom: 1px;
                font-size: 18px;
                cursor: pointer;
            }

            option:hover,
            .active {
                background-color: white;
                color: black;
            }
        </style>
        <script>
            input.onfocus = function() {
                pleadings.style.display = 'block';
                input.style.borderRadius = "5px 5px 0 0";
            };

            for (let option of pleadings.options) {
                option.onclick = function() {
                    input.value = option.value;
                    pleadings.style.display = 'none';
                    input.style.borderRadius = "5px";
                }
            };

            input.oninput = function() {
                currentFocus = -1;
                var text = input.value.toUpperCase();
                for (let option of pleadings.options) {
                    if (option.value.toUpperCase().indexOf(text) > -1) {
                        option.style.display = "block";
                    } else {
                        option.style.display = "none";
                    }
                };
            }
            var currentFocus = -1;
            input.onkeydown = function(e) {
                if (e.keyCode == 40) {
                    currentFocus++
                    addActive(pleadings.options);
                } else if (e.keyCode == 38) {
                    currentFocus--
                    addActive(pleadings.options);
                } else if (e.keyCode == 13) {
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (pleadings.options) pleadings.options[currentFocus].click();
                    }
                }
            }

            function addActive(x) {
                if (!x) return false;
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("active");
            }

            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("active");
                }
            }

            document.addEventListener('click', function(event) {
                if (!input.contains(event.target) && !pleadings.contains(event.target)) {
                    pleadings.style.display = 'none';
                    input.style.borderRadius = "5px";
                }
            });
        </script>
        <img src="../frontend2/Documents/hex.png" class="hexagons" alt="Outline of three hexagons">

    </body>

</html>