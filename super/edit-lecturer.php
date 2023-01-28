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
        <h1>Edit Lecturer</h1>
        <strong>"The biggest fool is one who cannot learn, even from their own mistakes"<br> ~Orji Michael Chukwuebuka</strong>
    </div>

    <div>
        <form action="functions/editLecturer.php" method="POST">
            <div class="p-1 form-control">
                <label>Select Lecturer</label><br>
                <input onkeyup='simpleAsyncSearch("functions/suggestLecturer", "lecturer_search_input", "suggestion_list1","assignToLecturerButton")' id="lecturer_search_input" type="text" placeholder="**Engr Ozor **Engrozor@gmail.com **32234234" required>
                <ul id="suggestion_list1">
                </ul>
            </div>
            <br>
            <hr>
            <br>
        
            <div class="p-1 form-control">
                <label>New Staff ID</label><br>
                <input type="text" placeholder="**39434873290" required>
            </div>

            <input type="submit" id="assignToLecturerButton" disabled value="Save">
        </form>
    </div>

    <!-- JS Includes -->
    <?php 
    require_once('includes/js_includes.php')
    ?>
</body>

</html>