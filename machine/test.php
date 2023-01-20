<?php
if (isset($_GET['machine_id']) && isset($_GET['card_id'])) {
    echo http_response_code(200);
} else {
    echo http_response_code(400);
}

// if (isset($_GET['machine_id']) && isset($_GET['card_id'])) {
//     echo convertTrueOrFalseToZeroAndOne(performJobAssignedToMachine($_GET['machine_id'], $_GET['card_id']));
//     die;
// }
// echo 'missing values';
// die;
