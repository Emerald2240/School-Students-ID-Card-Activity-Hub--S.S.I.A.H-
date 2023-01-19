<?php
if (isset($_GET['machine_id']) && isset($_GET['card_id'])) {
    $myfile = fopen($_GET['machine_id'] . 'Waiting.txt', "r") or die("0");
    return fread($myfile, filesize($_GET['machine_id'] . 'waiting.txt'));
    fclose($myfile);
}
