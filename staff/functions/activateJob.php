<?php
require_once('../config/connect.php');
require_once('functions.php');

if (isset($_GET['id'])) {

    $myMachine = getStaffsMachine($_SESSION['staff_id']);

    if (activateJob($_GET['id'], $myMachine['id'])) {
        gotoPage('../jobs?status=success');
    } else {
        gotoPage('../jobs?status=failure-DB');
    }
} else {
    gotoPage('../jobs?status=failure-items-missing');
}
