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
        <h1>Create Machine</h1>
        <strong>"And then the lord God formed man from the clay of the earth , and he breathed into his face the breath of life, and man became a living soul."<br> ~Genesis 2:7</strong>
    </div>

    <div>
        <form action="functions/createMachine.php" method="POST">
            <div class="p-1 form-control">
                <label>Machine Name</label><br>
                <input name="machine_name" type="text" placeholder="**CJ" required>
            </div>
            <div class="p-1 form-control">
                <label>Mark</label><br>
                <input name="mark" type="text" placeholder="**Mark #32" required>
            </div>
            <div class="p-1 form-control">
                <label>Machine Id</label><br>
                <input name="machine_id" type="text" placeholder="**567438732" required>
            </div>
            <input type="submit" value="Create">
        </form>
    </div>

     <!-- JS Includes -->
     <?php 
    require_once('includes/js_includes.php')
    ?>
</body>

</html>