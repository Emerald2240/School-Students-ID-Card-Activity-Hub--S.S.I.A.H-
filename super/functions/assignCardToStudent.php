<?php
require_once('../config/connect.php');
require_once('functions.php');


$studentInfo = getStudentInfoWithEmail($_POST['student_email']);

if (isset($studentInfo) && isset($_POST['card_id'])) {
    if ($_POST['card_id'] != '#') {
        if (!hasCardBeenUsed($_POST['card_id'])) {
            if (assignCardToStudent($studentInfo['id'], $_POST['card_id'])) {
                echo 'Card assigned successfully!';
            } else {
                echo 'unknown failure occured';
            }
        } else {
            echo 'Card ID Invalid. Scan New Card On Scanner Machine and try again.';
        }
    } else {
        echo 'Card ID Invalid. Scan New Card On Scanner Machine and try again.';
    }
}

?>

<div style="text-align:center"><a href="../index">Go Home</a></div>