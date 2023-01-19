<?php
require_once('../config/connect.php');
require_once('functions.php');


$staffInfo = getStaffInfoWithEmail($_POST['staff_email']);
$machineInfo = getMachineInfoWithName($_POST['machine_name']);

if (isset($staffInfo) && isset($machineInfo)) {
    if (assignMachineToStaff($staffInfo['id'], $machineInfo['id'])) {
        echo 'Machine assigned successfully!';
    } else {
        echo 'unknown failure occured';
    }
}

?>

<div style="text-align:center"><a href="../index">Go Home</a></div>