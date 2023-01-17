<?php
require_once('config/connect.php');
require_once('functions/functions.php');

echo '<pre>';

// print_r(getStaffsMachine(1));

// print_r(getJobFromId(1));

print_r(getActiveTaskForStaff(1));