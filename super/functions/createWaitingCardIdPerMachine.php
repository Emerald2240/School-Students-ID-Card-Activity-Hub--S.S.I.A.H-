<?php
if (isset($_GET['machine_id']) && isset($_GET['card_id'])) {
    $myfile = fopen("../".$_GET['machine_id'] . 'Waiting.txt', "w") or die("0");
    $txt = $_GET['card_id'];
    fwrite($myfile, $txt);
    fclose($myfile);
    echo 1;
    die;
}
echo 0;
die;

