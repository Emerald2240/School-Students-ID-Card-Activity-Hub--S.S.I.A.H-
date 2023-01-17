<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!$_SESSION['super_log']) {
    gotoPage('signin');
}
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

            <?php
            $myMachine = getStaffsMachine($_SESSION['staff_id']);
            $activeJobId = $myMachine['active_job_id'];
            $activeJobInfo = getJobFromId($activeJobId);
            ?>

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
                                            <div class="ac-line-transparent" id="apex-emplyoeeAnalytics"></div>
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
                                                            <span class="text-muted"><?= floor((count(getAllJobEntriesForJobId($activeJobId)) / count(getAllJobsForStaff($_SESSION['staff_id'])) * 100 )) ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <i class="text-success icofont-check fs-3"></i>
                                                            <h6 class="mt-3 mb-0 fw-bold small-14">Percentage Success</h6>
                                                            <span class="text-muted"><?= floor((getEntryValidity(getAllJobEntriesForJobId($activeJobId), true) / count(getAllJobEntriesForJobId($activeJobId)) ) * 100 )
                                                             ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <i class="text-danger icofont-close fs-3"></i>
                                                            <h6 class="mt-3 mb-0 fw-bold small-14">Percentage Negative</h6>
                                                            <span class="text-muted"><?= floor((getEntryValidity(getAllJobEntriesForJobId($activeJobId), false) / count(getAllJobEntriesForJobId($activeJobId)) ) * 100 )
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

        <!-- Modal Members-->
        <!-- <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="addUserLabel">Employee Invitation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="inviteby_email">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email address" id="exampleInputEmail1" aria-describedby="exampleInputEmail1">
                                <button class="btn btn-dark" type="button" id="button-addon2">Sent</button>
                            </div>
                        </div>
                        <div class="members_list">
                            <h6 class="fw-bold ">Employee </h6>
                            <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                                <li class="list-group-item py-3 text-center text-md-start">
                                    <div class="d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row">
                                        <div class="no-thumbnail mb-2 mb-md-0">
                                            <img class="avatar lg rounded-circle" src="assets/images/xs/avatar2.jpg" alt="">
                                        </div>
                                        <div class="flex-fill ms-3 text-truncate">
                                            <h6 class="mb-0  fw-bold">Rachel Carr(you)</h6>
                                            <span class="text-muted">rachel.carr@gmail.com</span>
                                        </div>
                                        <div class="members-action">
                                            <span class="members-role ">Admin</span>
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="icofont-ui-settings  fs-6"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item py-3 text-center text-md-start">
                                    <div class="d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row">
                                        <div class="no-thumbnail mb-2 mb-md-0">
                                            <img class="avatar lg rounded-circle" src="assets/images/xs/avatar3.jpg" alt="">
                                        </div>
                                        <div class="flex-fill ms-3 text-truncate">
                                            <h6 class="mb-0  fw-bold">Lucas Baker<a href="#" class="link-secondary ms-2">(Resend invitation)</a></h6>
                                            <span class="text-muted">lucas.baker@gmail.com</span>
                                        </div>
                                        <div class="members-action">
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Members
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="icofont-check-circled"></i>

                                                            <span>All operations permission</span>
                                                        </a>

                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fs-6 p-2 me-1"></i>
                                                            <span>Only Invite & manage team</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="icofont-ui-settings  fs-6"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Delete
                                                            Member</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item py-3 text-center text-md-start">
                                    <div class="d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row">
                                        <div class="no-thumbnail mb-2 mb-md-0">
                                            <img class="avatar lg rounded-circle" src="assets/images/xs/avatar8.jpg" alt="">
                                        </div>
                                        <div class="flex-fill ms-3 text-truncate">
                                            <h6 class="mb-0  fw-bold">Una Coleman</h6>
                                            <span class="text-muted">una.coleman@gmail.com</span>
                                        </div>
                                        <div class="members-action">
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Members
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="icofont-check-circled"></i>

                                                            <span>All operations permission</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fs-6 p-2 me-1"></i>
                                                            <span>Only Invite & manage team</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="btn-group">
                                                <div class="btn-group">
                                                    <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="icofont-ui-settings  fs-6"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Suspend
                                                                member</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-not-allowed fs-6 me-2"></i>Delete
                                                                Member</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    </div>

    <!-- Js Imports -->
    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/bundles/apexcharts.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>
    <!-- <script src="js/hr.js"></script> -->
    <?php require_once('js/hr2.php') ?>
    <!-- Custom Js -->
    <?php require_once('includes/js_imports.php') ?>

</body>


</html>