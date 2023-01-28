<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!isset($_SESSION['ultra_log'])) {
    gotoPage("../staff/index");
}

// gotoPage('active-courses');
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
        <h1>Create Department</h1>
        <strong>"And the lord said, let there be light, and there was light"<br> ~Genesis</strong>
    </div>

    <div>
        <form action="functions/createDepartment.php" method="POST">
            <div class="p-1 form-control">
                <label>Full Department Name</label><br>
                <input name="department_name" type="text" placeholder="**Computer Programming In Nigeria" required>
            </div>
            <div class="p-1 form-control">
                <label>Department Code</label><br>
                <input name="department_code" type="text" placeholder="**CEE123" required>
            </div>

            <input type="submit" id="newDepartmentButton" value="Create">
        </form>
    </div>

    <!-- JS Includes -->
    <?php 
    require_once('includes/js_includes.php')
    ?>
</body>

</html>