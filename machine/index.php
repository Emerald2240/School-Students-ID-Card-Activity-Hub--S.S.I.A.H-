<?php
require_once('config/connect.php');
require_once('functions/functions.php');



if (isset($_GET['machine_id']) && isset($_GET['card_id'])) {
    if (performJobAssignedToMachine($_GET['machine_id'], $_GET['card_id'])) {
        header("HTTP/1.1 200 True");
    } else {
        header("HTTP/1.1 400 False");
    }
} else {
    header("HTTP/1.1 400 OK");
}