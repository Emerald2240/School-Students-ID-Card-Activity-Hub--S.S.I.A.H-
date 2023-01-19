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
                $queryCondition = "WHERE first_name LIKE '%" . $wordsAry[$i] . "%' OR last_name LIKE '%" . $wordsAry[$i] . "%' "."OR email LIKE '%" . $wordsAry[$i] . "%' "."OR staff_id_number LIKE '%" . $wordsAry[$i] . "%' "."OR title LIKE '%" . $wordsAry[$i] . "%' ";

                if ($i != $wordsCount - 1) {
                    $queryCondition .= " OR ";
                }
            }
            //  }

            $orderby = " ORDER BY id asc";
            //echo $queryCondition;
            $query = "SELECT * FROM lecturers " . $queryCondition . $orderby . " LIMIT 0,6";
            $result = $db_handle->runQuery($query);
            if ($result) { ?>
                <?php
                foreach ($result as $lecturer) {
                    $fullName = $lecturer['first_name'] ." ".$lecturer['last_name']." | ".$lecturer['email']." | ".$lecturer['title']. " [" . $lecturer['staff_id_number'].']';
                    $email = $lecturer['email']
                ?>
                    <li onclick='selectSuggestion("<?= $email ?>","suggestion_list1", "lecturer_search_input","assignToLecturerButton")' class="suggestion_item"><?= $fullName ?></li>
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
