<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if(!$_SESSION['super_log']){
    gotoPage('signin');
}
