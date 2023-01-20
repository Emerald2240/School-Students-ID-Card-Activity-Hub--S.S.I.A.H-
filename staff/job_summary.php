<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!$_SESSION['super_log']) {
    gotoPage('signin');
}

$myMachine = getStaffsMachine($_SESSION['staff_id']);
$activeJobId = $myMachine['active_job_id'];
$activeJobInfo = getJobFromId($activeJobId);
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">



<head>
    <?php require_once('includes/head.php') ?>
    <title>:: S.S.I.A.H :: Staff Dashboard </title>
</head>

<body>

    <div id="mytask-layout" class="theme-indigo">
        <!-- include sidebar -->
        <?php require_once('includes/sidebar.php') ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php require_once('includes/header.php') ?>

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row clearfix g-3">
                        <div class="col-xl-8 col-lg-12 col-md-12 flex-column">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                            <h6 class="mb-0 fw-bold "><?= $activeJobInfo['name'] ?></h6>
                                        </div>
                                        <div class="card-body">
                                            <!-- apex-emplyoeeAnalytics -->
                                            <!-- apex-chart-line-column -->
                                            <!-- <div class="ac-line-transparent" id="apex-chart-line-column"></div> -->
                                            <div class="ac-line-transparent" id="apex-chart-line-column"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                            <h6 class="mb-0 fw-bold ">Task Stats</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-2 row-deck">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <i class="text-primary icofont-bars fs-3"></i>
                                                            <h6 class="mt-3 mb-0 fw-bold small-14">Job Percentage Overall</h6>
                                                            <span class="text-muted"><?= floor((count(getAllJobEntriesForJobId($activeJobId)) / count(getAllJobEntriesForStaff($_SESSION['staff_id'])) * 100)) ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <i class="text-success icofont-check fs-3"></i>
                                                            <h6 class="mt-3 mb-0 fw-bold small-14">Percentage Success</h6>
                                                            <span class="text-muted"><?= floor((getEntryValidity(getAllJobEntriesForJobId($activeJobId), true) / count(getAllJobEntriesForJobId($activeJobId))) * 100)
                                                                                        ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <i class="text-danger icofont-close fs-3"></i>
                                                            <h6 class="mt-3 mb-0 fw-bold small-14">Percentage Negative</h6>
                                                            <span class="text-muted"><?= floor((getEntryValidity(getAllJobEntriesForJobId($activeJobId), false) / count(getAllJobEntriesForJobId($activeJobId))) * 100)
                                                                                        ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                            <h6 class="mb-0 fw-bold ">Total Students</h6>
                                            <h4 class="mb-0 fw-bold "><?= count(getAllStudentsScannedPerJobId($activeJobId)) ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="mt-3" id="apex-MainCategories"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12">
                            <div class="row g-3 row-deck">
                                <div class="col-md-6 col-lg-6 col-xl-12">
                                    <div class="card bg-primary">
                                        <div class="card-body row">
                                            <div class="col">
                                                <span class="avatar lg bg-white rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-file-text fs-5"></i></span>
                                                <h1 class="mt-3 mb-0 fw-bold text-white"><?= count(getAllJobEntriesForJobId($activeJobId)) ?></h1>
                                                <span class="text-white">Scans</span>
                                            </div>
                                            <div class="col">
                                                <img class="img-fluid" src="assets/images/interview.svg" alt="interview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-12  flex-column">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center flex-fill">
                                                <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-users-alt-2 fs-5"></i></span>
                                                <div class="d-flex flex-column ps-3  flex-fill">
                                                    <h6 class="fw-bold mb-0 fs-4"><?= getEntryValidity(getAllJobEntriesForJobId($activeJobId), true) ?></h6>
                                                    <span class="text-muted">Valid Responses</span>
                                                </div>
                                                <i class="icofont-chart-bar-graph fs-3 text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center flex-fill">
                                                <span class="avatar lg light-danger-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-holding-hands fs-5"></i></span>
                                                <div class="d-flex flex-column ps-3 flex-fill">
                                                    <h6 class="fw-bold mb-0 fs-4"><?= getEntryValidity(getAllJobEntriesForJobId($activeJobId), false) ?></h6>
                                                    <span class="text-muted">Negative Responses</span>
                                                </div>
                                                <i class="icofont-chart-line fs-3 text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="card">
                                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                            <h6 class="mb-0 fw-bold ">Recently Scanned Students</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="flex-grow-1">
                                                <?php
                                                $count = 0;
                                                $scannedStudents = getAllStudentsScannedPerJobId($activeJobId);

                                                foreach ($scannedStudents as $studentId) {
                                                    if ($count > 6) {
                                                    } else {
                                                        $jobEntryInfo = getLatestJobEntryFromStudentForStaff($studentId, $_SESSION['staff_id']);
                                                        $studentInfo = getStudentInfo($studentId);
                                                        if (isset($jobEntryInfo) && isset($studentInfo)) {

                                                ?>
                                                            <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                                                <div class="d-flex align-items-center flex-fill">

                                                                    <?php if ($studentInfo['gender'] == 'Female') { ?>
                                                                        <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/lg/avatar2.jpg" alt="profile">
                                                                    <?php } else { ?>
                                                                        <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/lg/avatar3.jpg" alt="profile">
                                                                    <?php } ?>

                                                                    <div class="d-flex flex-column ps-3">
                                                                        <h6 class="fw-bold mb-0 small-14"><?= $studentInfo['first_name'] . " " . $studentInfo['last_name'] ?></h6>
                                                                        <span class="text-muted"><?= $studentInfo['set_year'] ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="time-block text-truncate">
                                                                    <i class="icofont-clock-time"></i> <?= formatDateHourAndMinute($jobEntryInfo['date_updated']) ?>
                                                                    <br>
                                                                    <?= formatDateFriendlier($jobEntryInfo['date_updated']) ?>
                                                                </div>
                                                            </div>
                                                <?php }
                                                        $count++;
                                                    }
                                                } ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- Row End -->
            </div>
        </div>


    </div>
    </div>

    <!-- Js Imports -->
    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/bundles/apexcharts.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="../js/template.js?v=<?php echo time(); ?>"></script>
    <!-- <script src="js/hr.js"></script> -->
    <?php require_once('js/hr2.php') ?>
    <!-- Custom Js -->
    <?php require_once('includes/js_imports.php') ?>

    <!-- Jquery Page Js -->
    <script>
        // employees Line Column
        $(document).ready(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false,
                    },
                },
                colors: ['var(--chart-color1)', 'var(--chart-color2)'],
                series: [{
                        name: 'Scans',
                        type: 'column',
                        // data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
                        data: [<?php foreach ($jobStatsAndDates[1] as $jobStat) {
                                    echo $jobStat . ',';
                                } ?> 0]
                    }

                ],
                stroke: {
                    width: [0, 4]
                },
                //labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],    
                // labels: ['2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012'],
                labels: [<?php foreach ($jobStatsAndDates[0] as $jobStat) {
                                echo "'" . $jobStat . "',";
                            } ?>],
                xaxis: {
                    type: 'datetime',
                    title: {
                        text: 'Days'
                    }
                },
                yaxis: [{
                    opposite: false,
                    title: {
                        text: 'Number Of Scans'
                    }
                }]
            }
            var chart = new ApexCharts(
                document.querySelector("#apex-chart-line-column"),
                options
            );

            chart.render();
        });
    </script>

</body>


</html>