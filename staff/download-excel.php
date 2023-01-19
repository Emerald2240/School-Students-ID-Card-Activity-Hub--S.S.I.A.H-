<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (isset($_GET['job_id'])) {
    $jobInfo = getJobFromId($_GET['job_id']);
    $taskInfo = getTaskFromId($jobInfo['task_id']);
    $allJobEntries = getAllJobEntriesForJobId($_GET['job_id']);
    // $allJobEntries = json_encode($allJobEntries, true);

    // echo $allJobEntries;
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <style>
        body {
            text-align: center;
        }
    </style>

    <body>

        <h3>Downloading Excel File</h3>
        <p>Please Wait.</p>
        <a href="jobs">Go Back to Jobs</a>

        <!-- Excel JS File -->
        <script src="js/xlsx.full.min.js"></script>

        <!-- (C) JAVASCRIPT -->
        <script>
            //  document.getElementById("demo").onclick = () => {
            // (C1) DUMMY DATA
            // var data = [
            //     ["Joa Doe", "joa@doe.com"],
            //     ["Job Doe", "job@doe.com"],
            //     ["Joe Doe", "joe@doe.com"],
            //     ["Jon Doe", "jon@doe.com"],
            //     ["Joy Doe", "joy@doe.com"]
            // ];

            function convertJsonToArray(jsonObject) {
                var obj = JSON.parse(jsonObject);
                var res = [];

                for (var i in obj)
                    res.push(obj[i]);

                return res;
            }


            var data = <?php

                        echo '[';
                        echo '["Student Reg Number", "Student Name", "Scan Response", "Date", "Time"],';
                        foreach ($allJobEntries as $jobEntry) {
                            $studentInfo = getStudentInfo($jobEntry['student_id']);
                            $studentName =  $studentInfo['first_name'] . " " . $studentInfo['last_name'];
                            echo '["' . $studentInfo['reg_no'] . '",' . '"' . $studentName . '",' . '"' . $jobEntry['response'] . '",' . '"' . formatDateFriendlier($jobEntry['date_updated']) . '",' . '"' . formatDateHourAndMinute($jobEntry['date_updated']) . '"],';
                        }
                        echo '["", "", "", "", ""]]';

                        ?>;

            // console.log(data);

            // var dataAsArray = convertJsonToArray(data);
            // console.log(data);

            // (C2) CREATE NEW EXCEL "FILE"
            var workbook = XLSX.utils.book_new(),
                worksheet = XLSX.utils.aoa_to_sheet(data);
            workbook.SheetNames.push("First");
            workbook.Sheets["First"] = worksheet;

            // (C3) "FORCE DOWNLOAD" XLSX FILE
            let filename = "<?= shortenText($jobInfo['name'], 25) . "(" . $taskInfo['name'] . ")" ?>.xlsx";
            XLSX.writeFile(workbook, filename);
            window.location = 'jobs.php?status=success';
            //  };
        </script>
    </body>

    </html>




<?php
} else {
    gotoPage('jobs?status=failure-items-missing');
}
