<?php session_start(); ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include_once("inc/head.inc"); ?>
    <link href="inc/dashboard.css" rel="stylesheet">
</head>
<body>
<div id="main" class="container theme-showcase" role="main">
    <div id="title" class="jumbotron">
        <h2>Informatik-Unterricht</h2>
        <h4>Bildungszentrum Zürichsee<br/>Beruf Mediamatiker/-innen EFZ</h4>
    </div>

    <?php
        require_once(__DIR__ . '/lib/Navigation.php');
        $nav = new Navigation();
        if (isset($_GET["clear"])){
            if ($_GET["clear"]=="all"){
                $nav->clearSettings("all");
            }
        } else {
            $nav->readSettings();
        }
    ?>

    <div id="message"></div>
    <p id="data"></p>

    <div>
    <form id="frmStep01">
        <fieldset>
            <div>
                <select id="selStep01" name="selStep01">
                    <option value="none">Wählen Sie Lehrperson:</option>
                    <option value="lp01">Frau E. Mastrandrea</option>
                    <option value="lp02">Herr D. Garavaldi</option>
                </select>&nbsp;&nbsp;
                <input class="btn btn-primary" type="submit" id="contStep01" name="contStep01" value="Continue" disabled/>
            </div>
        </fieldset>
    </form>
    <form id="frmStep02">
        <fieldset>
            <div>
                <select name="selStep02" id="selStep02">
                    <option value="none">Wählen Sie das Informatik-Semester:</option>
                    <option value="01">ict-01: IT-Grundlagen</option>
                    <option value="02">ict-02: HTML5 und CSS3</option>
                    <option value="03">ict-03: Javascript und Multimedia</option>
                    <option value="04">ict-04: Serverseitige Scriptsprachen</option>
                    <option value="05">ict-05: IT-Netzwerke und Serverdienste</option>
                    <option value="06">ict-06: Datenbanken</option>
                    <option value="07">ict-07: IT-Sicherheit, Webdesign</option>
                    <option value="08">ict-08: Webprojekt, Repetition</option>
                    <option value="pw01">pw-01: Projektwoche IPERKA</option>
                </select>&nbsp;&nbsp;
                <input  type="submit" class="btn btn-primary" name="contStep02" value="Continue"/>&nbsp;&nbsp;
                <input type="submit" class="btn btn-light" id="backStep02" name="backStep02" value="Back"/>
            </div>
            <div>
                <label for="chkSaveUrl">Save settings</label>
                <input type="checkbox" id="chkSaveUrl" name="chkSaveUrl" value="saveUrl"/>
            </div>
        </fieldset>
    </form>
    </div>
</div>

<script>
    var lp_key = "none";
    var lp_text = "";
    //Semester
    var sem_key = "none";
    var saveInCookie = false;

    /* Hide first step 02*/
    $('#frmStep02').hide();

    /* enable continue button which doesn't depend from the selected value */
    $('#selStep01').click(function () {
        if ($('#contStep01').is(':disabled')) {
            $('#contStep01').removeAttr('disabled');
        }
        //$('#message').html('Button is enabled!');
    });

    /* Submit data by form 1 - selected teacher*/
    $("#frmStep01").on("submit", function (e) {
        e.preventDefault();
        //Show selected values - Option 1b:
        lp_key = $("#selStep01").val();
        lp_text = $("#selStep01 option:selected").text();

        //post data from form
        $.post(
            "process_teacher.php",
            {lp: lp_key},
        );

        //$('#message').html('Lehrperson ' + lp_text + ' (' + lp_key +') submitted.');
        $('#message').html('Lehrperson ' + lp_text + ' gewählt.');
        $('#message').addClass("alert alert-info");
        $('#message').attr('role', "alert");
        if (lp_key == "none") {
            $('#message').html('Did not select a correct value!');
        } else {
            //hide form 01
            $("#frmStep01").hide();
            //show form 02
            $("#frmStep02").show();
        }
    });

    /* Submit data by form 2 */
    $("#frmStep02").on("submit", function (e) {
        e.preventDefault();
        sem_key = $("#selStep02").val();
        sem_key = $("#selStep02").val();
        //post data from form
        $.post(
            "process_semester.php",
            {sem: sem_key, cookie: saveInCookie},
            function (daten) {
                $("#frmStep02").hide();
                $("#title").hide();
                $("#message").hide();

                //display data from the server
                // $('#message').html('Semester: ' + sem_key + ' submitted.');
                $('#data').html(daten);
            }
        );
    });

    //if checkbox for saving is selected, then save lp_key | sem_key in a cookie
    $('#chkSaveUrl').click(function () {
        if ($('#chkSaveUrl').is(':checked')) {
            saveInCookie = true;
            $('#message').html('Will be saved in cookies!');
        } else {
            saveInCookie = false;
            $('#message').html('Will be NOT saved in cookies!');
        }
    });


    /* step back when back-button is pressed from form 2 */
    $("#backStep02").on("click", function (e) {
        e.preventDefault();
        $("#frmStep01").show();
        //Formular 02 zeigen
        $("#frmStep02").hide();
    });
</script>

</body>
</html>