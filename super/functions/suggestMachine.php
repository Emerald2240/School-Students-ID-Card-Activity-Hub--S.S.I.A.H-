<?php
require_once('../config/connect.php');
require_once('functions.php');
//die;

switch ($_POST) {
    case (isset($_POST['keyword'])):
        if (!empty($_POST['keyword'])) {

            //if (!empty($category)) {

            $wordsAry = explode(" ", $_POST['keyword']);
            $wordsCount = count($wordsAry);
            for ($i = 0; $i < $wordsCount; $i++) {

                $queryCondition = "WHERE name LIKE '%" . $wordsAry[$i] . "%' OR machine_id LIKE '%" . $wordsAry[$i] . "%' ";

                if ($i != $wordsCount - 1) {
                    $queryCondition .= " OR ";
                }
            }
            //  }






            $orderby = " ORDER BY id asc";
            //echo $queryCondition;
            $query = "SELECT * FROM machines " . $queryCondition . $orderby . " LIMIT 0,6";
            $result = $db_handle->runQuery($query);
            if ($result) { ?>
                <?php
                foreach ($result as $machine) {
                    $fullName = $machine['name'] . " [" . $machine['machine_id'] . ']';
                    $machineCode = $machine['name'];
                ?>
                    <li onclick='selectSuggestion("<?= $machineCode ?>","suggestion_list2", "machine_search_input","assignToStaffButton")' class="suggestion_item"><?= $fullName ?></li>
                <?php } ?>
<?php }
        }
        // else {
        //     $wordsAry = explode(" ", $_POST['keyword']);
        //     $wordsCount = count($wordsAry);
        //     for ($i = 0; $i < $wordsCount; $i++) {

        //         $queryCondition = "WHERE reg_no LIKE '%" . $wordsAry[$i] . "%' OR reg_no LIKE '%" . $wordsAry[$i] . "%' ";

        //         if ($i != $wordsCount - 1) {
        //             $queryCondition .= " OR ";
        //         }
        //     }
        // }




        break;
    default:
        # code...
        print json_encode([['error' => 'Invalid Action']]);
        break;
}
