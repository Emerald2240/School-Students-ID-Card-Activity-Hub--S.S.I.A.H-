<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if(!$_SESSION['super_log']){
    gotoPage('signin');
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">


<!-- Mirrored from www.pixelwibes.com/template/my-task/html/dist/attendance-employees.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Jan 2023 10:03:26 GMT -->

<head>
    <?php require_once('includes/head.php') ?>

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
    <title>:: My-Task:: Attendance Employess</title>
</head>

<body>

    <div id="mytask-layout" class="theme-indigo">

        <!-- sidebar -->
        <?php require_once('includes/sidebar.php') ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php require_once('includes/header.php') ?>

            <!-- Body: Body -->
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center g-3 mb-3">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Employees View</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row align-item-center row-deck g-3 mb-3">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-header py-3">
                                    <h6 class="mb-0 fw-bold ">Today Time Utilisation</h6>
                                </div>
                                <div class="card-body">
                                    <div class="timesheet-info d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="intime d-flex align-items-center mt-2">
                                            <i class="icofont-finger-print fs-4 color-light-success"></i>
                                            <span class="fw-bold ms-1">Punching: 10:00 Am</span>
                                        </div>
                                        <div class="outtime mt-2 w-sm-100">
                                            <button type="button" class="btn btn-dark w-sm-100"><i class="icofont-foot-print me-2"></i>Punch Out</button>
                                        </div>
                                    </div>
                                    <div id="apex-circle-chart"></div>
                                    <div class="timesheet-info d-flex align-items-center justify-content-around flex-wrap">
                                        <div class="intime d-flex align-items-center">
                                            <i class="icofont-lunch fs-3 color-lavender-purple"></i>
                                            <span class="fw-bold ms-1">Break: 1:10 Hr</span>
                                        </div>
                                        <div class="intime d-flex align-items-center">
                                            <i class="icofont-ui-timer fs-4 color-light-success"></i>
                                            <span class="fw-bold ms-1">Overtime: 02:10 Hr</span>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- .card: My Timeline -->
                        </div>
                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                    <h6 class="m-0 fw-bold">Employess Yearly Status</h6>
                                </div>
                                <div class="card-body">
                                    <div id="apex-chart-line-column"></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3 mb-3">
                        <div class="col-lg-12 col-md-12 flex-column">
                            <div class="row g-3 row-deck">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                    <div class="card">
                                        <div class="card-header py-3">
                                            <h6 class="mb-0 fw-bold ">Statistics</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="progress-count mb-5">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="mb-0 fw-bold d-flex align-items-center">Today</h6>
                                                    <span class="small text-muted">02/08</span>
                                                </div>
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar light-info-bg" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="progress-count mb-5">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="mb-0 fw-bold d-flex align-items-center">This Week</h6>
                                                    <span class="small text-muted">01/40</span>
                                                </div>
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar bg-lightgreen" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="progress-count mb-5">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="mb-0 fw-bold d-flex align-items-center">This Month</h6>
                                                    <span class="small text-muted">02/160</span>
                                                </div>
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar light-success-bg" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="progress-count mb-5">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="mb-0 fw-bold d-flex align-items-center">Overtime</h6>
                                                    <span class="small text-muted">15:30 Hr</span>
                                                </div>
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar light-orange-bg" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="progress-count mb-5">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="mb-0 fw-bold d-flex align-items-center">Remaining</h6>
                                                    <span class="small text-muted">01/08</span>
                                                </div>
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar bg-lightyellow" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                    <div class="card">
                                        <div class="card-header py-3">
                                            <h6 class="mb-0 fw-bold ">Recent Activity</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="timeline-item ti-danger border-bottom ms-2">
                                                <div class="d-flex">
                                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">PH</span>
                                                    <div class="flex-fill ms-3">
                                                        <div class="mb-1"><strong>Punch In at</strong></div>
                                                        <span class="d-flex text-muted align-items-center"><i class="icofont-ui-clock me-1"></i> 10 Am</span>
                                                    </div>
                                                </div>
                                            </div> <!-- timeline item end  -->
                                            <div class="timeline-item ti-info border-bottom ms-2">
                                                <div class="d-flex">
                                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">PO</span>
                                                    <div class="flex-fill ms-3">
                                                        <div class="mb-1"><strong>Punch Out at</strong></div>
                                                        <span class="d-flex text-muted align-items-center"><i class="icofont-ui-clock me-1"></i> 11:30 Am</span>
                                                    </div>
                                                </div>
                                            </div> <!-- timeline item end  -->
                                            <div class="timeline-item ti-info border-bottom ms-2">
                                                <div class="d-flex">
                                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning">BR</span>
                                                    <div class="flex-fill ms-3">
                                                        <div class="mb-1"><strong>Break Time</strong></div>
                                                        <span class="d-flex text-muted align-items-center"><i class="icofont-ui-clock me-1"></i> 1 Pm to 2 Pm</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item ti-success  border-bottom ms-2">
                                                <div class="d-flex">
                                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">PO</span>
                                                    <div class="flex-fill ms-3">
                                                        <div class="mb-1"><strong>Punch IN at</strong></div>
                                                        <span class="d-flex text-muted align-items-center"><i class="icofont-ui-clock me-1"></i> 2:10 Pm</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item ti-info ms-2">
                                                <div class="d-flex">
                                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">PO</span>
                                                    <div class="flex-fill ms-3">
                                                        <div class="mb-1"><strong>Punch Out at</strong></div>
                                                        <span class="d-flex text-muted align-items-center"><i class="icofont-ui-clock me-1"></i> 7:30 Pm</span>
                                                    </div>
                                                </div>
                                            </div> <!-- timeline item end  -->
                                        </div>
                                    </div> <!-- .card: My Timeline -->
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0 text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Puchin Time</th>
                                                <th>Puchout Time</th>
                                                <th>Break Time</th>
                                                <th>Half Day</th>
                                                <th>Full Day</th>
                                                <th>Overtime</th>
                                                <th>Total Production</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>June 26, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>02</td>
                                                <td>June 25, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>03</td>
                                                <td>June 24, 2021</td>
                                                <td class="text-success">10:00 AM</td>
                                                <td class="text-danger">02:00 PM</td>
                                                <td class="text-danger">00:00 </td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td class="text-success">00:00</td>
                                                <td class="text-success fw-bold">04:00 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>04</td>
                                                <td>June 23, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">03:05 PM</td>
                                                <td class="text-danger">00:00 </td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td class="text-success">00:00</td>
                                                <td class="text-success fw-bold">05:00 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>05</td>
                                                <td>June 22, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>06</td>
                                                <td>June 21, 2021</td>
                                                <td class="text-success">10:15 AM</td>
                                                <td class="text-danger">02:15 PM</td>
                                                <td class="text-danger">00:00 </td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td class="text-success">00:00</td>
                                                <td class="text-success fw-bold">04:00 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>07</td>
                                                <td>June 18, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>08</td>
                                                <td>June 17, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>09</td>
                                                <td>June 16, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>June 15, 2021</td>
                                                <td class="text-success">00:00</td>
                                                <td class="text-danger">00:00</td>
                                                <td class="text-danger">00:00</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td class="text-success">00:00</td>
                                                <td class="text-success fw-bold">00:00</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>June 14, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>June 11, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>June 10, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>June 09, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>June 08, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>June 07, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>June 04, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>June 03, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>19</td>
                                                <td>June 02, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                            <tr>
                                                <td>20</td>
                                                <td>June 01, 2021</td>
                                                <td class="text-success">10:05 AM</td>
                                                <td class="text-danger">09:05 PM</td>
                                                <td class="text-danger">01:12 Hr</td>
                                                <td><i class="icofont-close-circled text-danger"></i></td>
                                                <td><i class="icofont-check-circled text-success"></i></td>
                                                <td class="text-success">01:39 Hr</td>
                                                <td class="text-success fw-bold">09:39 Hr</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row End -->
                </div>
            </div>

            <!-- Modal Members-->
            <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
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
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
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
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Delete Member</a></li>
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
                                                            <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                                            <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
                                                            <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Suspend member</a></li>
                                                            <li><a class="dropdown-item" href="#"><i class="icofont-not-allowed fs-6 me-2"></i>Delete Member</a></li>
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
            </div>

        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/apexcharts.bundle.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <script src="../js/template.js"></script>
    <!-- Jquery Page Js -->
    <script>
        // project data table
        $(document).ready(function() {
            $('#myProjectTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });
        });
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
                    name: 'Working Hours',
                    type: 'column',
                    data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
                }, {
                    name: 'Employees Progress',
                    type: 'line',
                    data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
                }],
                stroke: {
                    width: [0, 4]
                },
                //labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],    
                labels: ['2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012'],
                xaxis: {
                    type: 'datetime'
                },
                yaxis: [{
                    title: {
                        text: 'Working Hours',
                    },

                }, {
                    opposite: true,
                    title: {
                        text: 'Employees Progress'
                    }
                }]
            }
            var chart = new ApexCharts(
                document.querySelector("#apex-chart-line-column"),
                options
            );

            chart.render();
        });

        // employees circle
        $(document).ready(function() {
            var options = {
                chart: {
                    height: 250,
                    type: 'radialBar',
                },
                colors: ['var(--chart-color1)'],
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '70%',
                        }
                    },
                },
                series: [70],
                labels: ['Working'],
            }
            var chart = new ApexCharts(
                document.querySelector("#apex-circle-chart"),
                options
            );

            chart.render();
        });
    </script>
</body>

<!-- Mirrored from www.pixelwibes.com/template/my-task/html/dist/attendance-employees.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Jan 2023 10:03:26 GMT -->

</html>