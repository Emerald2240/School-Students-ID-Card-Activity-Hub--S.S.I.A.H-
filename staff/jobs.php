<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!$_SESSION['super_log']) {
    gotoPage('signin');
}
$myMachine = getStaffsMachine($_SESSION['staff_id']);
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">



<head>
    <?php require_once('includes/head.php') ?>

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">

    <title>:: My-Task:: Jobs</title>
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
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">My Jobs</h3>
                                <div class="col-auto d-flex w-sm-100">
                                    <?php
                                    if ($myMachine) {
                                    ?>
                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#tickadd"><i class="icofont-plus-circle me-2 fs-6"></i>Create Job</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Job ID</th>
                                                <th>Title</th>
                                                <th>Task</th>
                                                <th>Date Created</th>
                                                <th>Status</th>
                                                <th>Scans</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $jobs = getAllJobsForStaff($_SESSION['staff_id']);
                                            $activeJob = getActiveJobForStaff($_SESSION['staff_id']);
                                            foreach ($jobs as $job) {
                                                $task = getTaskFromId($job['task_id']);
                                                $jobScans = getAllJobEntriesForJobId($job['id']);
                                                if (!$jobScans) {
                                                    $jobScans = 0;
                                                } else {
                                                    $jobScans = count($jobScans);
                                                }

                                            ?>
                                                <tr>
                                                    <td>
                                                        <span class="fw-bold text-secondary"><?= $job['id'] ?></span>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($job['id'] == $activeJob) { ?>
                                                            <strong><?= shortenText($job['name'], 25) ?></strong>
                                                        <?php } else { ?>
                                                            <?= shortenText($job['name'], 25) ?>
                                                        <?php } ?>


                                                    </td>
                                                    <td>
                                                        <span class="fw-bold ms-1"><?= $task['name'] ?></span>
                                                    </td>
                                                    <td>
                                                        <?= formatDateFriendlier($job['date_updated']) ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($myMachine) {
                                                            if ($job['id'] == $activeJob) { ?>
                                                                <span class="badge bg-danger">Active</span>
                                                            <?php } else { ?>
                                                                <a href="functions/activateJob?id=<?= $job['id'] ?>"><span class="badge bg-success">Waiting</span></a>
                                                        <?php }
                                                        } ?>

                                                    </td>
                                                    <td>
                                                        <?= $jobScans ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary" onclick="setEditJobModalValues('<?= $job['name'] ?>', <?= $job['id'] ?>)" data-bs-toggle="modal" data-bs-target="#edittickit"><i class="icofont-edit text-success"></i></button>
                                                            <!-- <a href="" type="button" onclick="sweetAlertConfirmation(`functions/deleteJob?id=<?= $job['id'] ?>`)" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></a> -->
                                                            <button type="button" href="" onclick="sweetAlertConfirmation(`functions/deleteJob?id=<?= $job['id'] ?>`)" class="btn btn-outline-secondary"><i class="icofont-ui-delete text-danger"></i></button>
                                                            <!-- <a href="download-excel?job_id=<?= $job['id'] ?>" type="button" class="btn btn-outline-secondary"><i class="icofont-download text-primary"></i></a> -->
                                                            <button type="button" onclick="sweetAlertDownloadConfirmation('download-excel?job_id=<?= $job['id'] ?>', 'download-csv?job_id=<?= $job['id'] ?>')" type="button" class="btn btn-outline-secondary"><i class="icofont-download text-primary"></i></a>

                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                            }
                                            ?>

                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row End -->
                </div>
            </div>

            <!-- Add Tickit-->
            <div class="modal fade" id="tickadd" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Create Job</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="functions/newJob.php" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="sub" class="form-label">Title</label>
                                    <input type="text" name="job_title" class="form-control" id="sub">
                                </div>
                                <div class="deadline-form">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Task</label>
                                    <select name="task" class="form-select">
                                        <option selected value="1">School Fees</option>
                                        <option value="2">Departmental Fees</option>
                                        <option value="3">Faculty Fees</option>
                                        <option value="4">Attendance</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button onclick type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Tickit-->
            <div class="modal fade" id="edittickit" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="edittickitLabel"> Edit Job</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="functions/updateJob.php" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="sub" class="form-label">Title</label>
                                    <input type="text" id="job_title_modal" name="job_title" class="form-control">
                                </div>
                                <div class="deadline-form">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Task</label>
                                    <select name="job_task" class="form-select">
                                        <option selected value="1">School Fees</option>
                                        <option value="2">Departmental Fees</option>
                                        <option value="3">Faculty Fees</option>
                                        <option value="4">Attendance</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="sub" class="form-label">Job ID</label>
                                    <input readonly type="text" id="job_id_modal" name="job_id" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button onclick type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="../js/template.js?v=<?php echo time(); ?>"></script>
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
                    }],
                    order: [
                        [4, 'asc']
                    ]
                });
            $('.deleterow').on('click', function() {
                var tablename = $(this).closest('table').DataTable();
                tablename
                    .row($(this)
                        .parents('tr'))
                    .remove()
                    .draw();

            });
        });
    </script>

    <!-- Custom Js -->
    <?php require_once('includes/js_imports.php') ?>



</body>


</html>