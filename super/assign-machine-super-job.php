<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!isset($_SESSION['ultra_log'])) {
    gotoPage("../staff/index");
}

// gotoPage('active-Machines');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#S##@@U@#@P#**E*@#R$@#!@$#@$%#@ AdMin</title>
    <link rel="stylesheet" href="includes/style.css">
</head>

<body>
    <div class="header">
        <h1>Assign Super Job to Machine</h1>
        <strong>"Perform your task and i shall know you. Perform your task and your genius shall befriend the more."<br> ~Ogwo David Emenike</strong>
    </div>

    <div>
        <form action="functions/assignJobToMachine.php" method="POST">
            <div class="p-1 form-control">
                <label>Machine</label><br>
                <input name="machine_name" onkeyup='simpleAsyncSearch("functions/suggestMachine", "machine_search_input", "suggestion_list2","assignToStaffButton")' id="machine_search_input" type="text" placeholder="**23jan1690515  **The Prototype" required>
                <ul id="suggestion_list2">
                </ul>
            </div>
            <input type="submit" disabled id="assignToStaffButton" value="Assign">

        </form>
    </div>

    <!-- JS Includes -->
    <?php
    require_once('includes/js_includes.php')
    ?>
</body>

</html>