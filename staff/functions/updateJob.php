<?php
require_once('../config/connect.php');
require_once('functions.php');

if (isset($_POST['job_id']) && isset($_POST['job_title']) && isset($_POST['job_task'])) {

    if (updateJob($_POST['job_id'], $_POST['job_title'], $_POST['job_task'])) {
        gotoPage('../jobs?status=success');
    } else {
        gotoPage('../jobs?status=failure-DB');
    }
} else {
    gotoPage('../jobs?status=failure-items-missing');
}
