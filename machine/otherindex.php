<?php
require_once('config/connect.php');
require_once('functions/functions.php');



if (isset($_GET['machine_id']) && isset($_GET['card_id'])) {
    if (performJobAssignedToMachine($_GET['machine_id'], $_GET['card_id'])) {
        echo '1';
    } else {
        echo '0';
    }
} else {
echo 0;
}
