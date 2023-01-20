<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (isset($_GET['machine_id']) && isset($_GET['card_id'])) {
    echo convertTrueOrFalseToZeroAndOne(performJobAssignedToMachine($_GET['machine_id'], $_GET['card_id']));
    die;
}
echo 'missing values';
die;
