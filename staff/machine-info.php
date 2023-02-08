<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!$_SESSION['super_log']) {
    gotoPage('signin');
}

$machineInfo = getStaffsMachine($_SESSION['staff_id']);
$activeJobInfo = getJobFromId($machineInfo['active_job_id']);
if (!$machineInfo) {
    gotoPage('index');
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">



<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>:: S.S.I.A.H :: Machine Info</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>

<body>

    <div id="mytask-layout" class="theme-indigo">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5 ">

            <!-- Body: Body -->
            <div style="margin-top: 6%;" class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">

                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">
                                <div class="text-center mb-5">
                                    <svg width="4rem" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                    </svg>
                                </div>
                                <div class="mb-5">
                                    <h2 class="color-900 text-center">School Students ID Activity Hub Machine Info</h2>
                                </div>
                                <!-- Image block -->
                                <div class="">
                                    <!-- <img src="assets/images/machine.svg" alt="login-img"> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
                                <!-- Form -->
                                <form class="row g-1 p-3 p-md-4">
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>Machine Info</h1>
                                        <span><?= $machineInfo['mark'] ?></span>
                                    </div>
                                    <div class="col-12 text-center mb-4">
                                        
                                        <!-- <span class="dividers text-muted mt-4">OR</span> -->
                                        <hr>
                                    </div>
                                    <div style="text-align: center;" class="col-12">
                                        <div  class="mb-2">
                                            <h4><i>~ <?= $machineInfo['name'] ?> ~</i></h4><p style="font-size: 8px;"><i><?= $machineInfo['machine_id'] ?></i></p> <br>
                                            Current Handler: <strong><?= $_SESSION['full_name'] ?></strong><br>
                                            Active Job: <strong><?= shortenText($activeJobInfo['name'], 25) ?></strong><br><br>

                                            WiFi/SSID Name: Free Data <br>
                                            Password:  free dataxyz
                                        
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                          
                                        </div>
                                    </div>
                                    <div class="col-12">

                                    </div>
                                    <div class="col-12 text-center mb-4">
                                        <a class="btn btn-lg btn-outline-secondary btn-block" href="index">
                                            <span class="d-flex justify-content-center align-items-center">
                                                <img class="avatar xs me-2" src="assets/images/arrow-left.svg" alt="Image Description">
                                                Go Back
                                            </span>
                                        </a>
                                        <!-- <span class="dividers text-muted mt-4">OR</span> -->
                                        <hr>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div> <!-- End Row -->
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Custom Js -->
    <?php require_once('includes/js_imports.php') ?>

</body>


</html>