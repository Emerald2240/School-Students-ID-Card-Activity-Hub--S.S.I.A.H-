<?php
require_once('../config/connect.php');
require_once('functions.php');

if (isset($_POST['job_title']) && isset($_POST['task'])) {
    if (createNewJob($_POST['job_title'], $_POST['task'], $_SESSION['staff_id'])) {
        gotoPage('../jobs?status=success');
    } else {
        gotoPage('../jobs?status=failure-DB');
    }
} else {
    gotoPage('../jobs?status=failure-items-missing');
}
