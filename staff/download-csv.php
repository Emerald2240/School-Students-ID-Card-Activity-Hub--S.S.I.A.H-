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

        <h3>Downloading CSV File</h3>
        <p>Please Wait.</p>
        <a href="jobs">Go Back to Jobs</a><br><br>

        <!-- CSV Javascript -->
        <script>
            //create CSV file data in an array  
            // var csvFileData = [  
            //    ['Alan Walker', 'Singer'],  
            //    ['Cristiano Ronaldo', 'Footballer'],  
            //    ['Saina Nehwal', 'Badminton Player'],  
            //    ['Arijit Singh', 'Singer'],  
            //    ['Terence Lewis', 'Dancer']  
            // ]; 

            var csvFileData = <?php

                                echo '[';
                                // echo '["Student Reg Number", "Student Name", "Scan Response", "Date", "Time"],';
                                foreach ($allJobEntries as $jobEntry) {
                                    $studentInfo = getStudentInfo($jobEntry['student_id']);
                                    $studentName =  $studentInfo['first_name'] . " " . $studentInfo['last_name'];
                                    echo '["' . $studentInfo['reg_no'] . '",' . '"' . $studentName . '",' . '"' . $jobEntry['response'] . '",' . '"' . formatDateFriendlier($jobEntry['date_updated']) . '",' . '"' . formatDateHourAndMinute($jobEntry['date_updated']) . '"],';
                                }
                                echo '["", "", "", "", ""]]';

                                ?>;

            //create a user-defined function to download CSV file   
            function download_csv_file() {

                //define the heading for each row of the data  
                // var csv = 'Name,Profession\n';  
                var csv = 'Student Reg Number,Student Name,Scan Response,Date,Time\n';

                //merge the data with CSV  
                csvFileData.forEach(function(row) {
                    csv += row.join(',');
                    csv += "\n";
                });

                //display the created CSV data on the web browser   
                // document.write(csv);


                var hiddenElement = document.createElement('a');
                hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
                hiddenElement.target = '_blank';

                //provide the name for the CSV file to be downloaded  
                hiddenElement.download = '<?= shortenText($jobInfo['name'], 25) . "(" . $taskInfo['name'] . ")" ?>.csv';
                hiddenElement.click();
            }
            download_csv_file();
            window.location = 'jobs.php?status=success';
        </script>
    </body>

    </html>




<?php
} else {
    gotoPage('jobs?status=failure-items-missing');
}
