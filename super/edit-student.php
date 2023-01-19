<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!isset($_SESSION['ultra_log'])) {
    gotoPage("../index");
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
        <h1>Edit Student</h1>
        <strong>"The biggest fool is one who cannot learn, even from their own mistakes"<br> ~Orji Michael Chukwuebuka</strong>
    </div>

    <div>
        <form action="functions/editLecturer.php" method="POST">
            <div class="p-1 form-control">
                <label>Select Student</label><br>
                <input onkeyup='simpleAsyncSearch("functions/suggestStudent", "student_search_input", "suggestion_list1","updateStudentButton")' id="student_search_input" type="text" placeholder="**Orji Michael **2017030180311 **08148863871 **Orjimichael4886@gmail.com" required>
                <ul id="suggestion_list1">
                </ul>
            </div>
            <br>
            <hr>
            <br>

            <div class="p-1 form-control">
                <label>First Name</label><br>
                <input type="text" placeholder="**Michael" required>
            </div>
            <div class="p-1 form-control">
                <label>Last Name</label><br>
                <input type="text" placeholder="**Orji" required>
            </div>
            <div class="p-1 form-control">
                <label>Gender</label><br>
                <select>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <!-- <div class="p-1 form-control">
                <label>Reg No</label><br>
                <input type="text" placeholder="**39434873290" required>
            </div> -->
            <div class="p-1 form-control">
                <label>Department</label><br>
                <input onkeyup='simpleAsyncSearch("functions/suggestDept", "department_search_input", "suggestion_list","newCourseButton")' id="department_search_input" type="text" placeholder="**Computer Engineering" required>
                <ul id="suggestion_list">
                </ul>
            </div>


            <input type="submit" id="newCourseButton" value="Save">
        </form>
    </div>

    <!-- JS Includes -->
    <?php
    require_once('includes/js_includes.php')
    ?>
</body>

</html>