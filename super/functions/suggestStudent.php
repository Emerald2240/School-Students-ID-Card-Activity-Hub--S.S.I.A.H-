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
                $queryCondition = "WHERE first_name LIKE '%" . $wordsAry[$i] . "%' OR last_name LIKE '%" . $wordsAry[$i] . "%' " . "OR email LIKE '%" . $wordsAry[$i] . "%' " . "OR reg_no LIKE '%" . $wordsAry[$i] . "%' " . "OR phone LIKE '%" . $wordsAry[$i] . "%' ";

                if ($i != $wordsCount - 1) {
                    $queryCondition .= " OR ";
                }
            }
            //  }

            $orderby = " ORDER BY id asc";
            //echo $queryCondition;
            $query = "SELECT * FROM students " . $queryCondition . $orderby . " LIMIT 0,6";
            $result = $db_handle->runQuery($query);
            if ($result) { ?>
                <?php
                foreach ($result as $student) {
                    $fullName = $student['first_name'] . " " . $student['last_name'] . " | " . $student['email'] . " | " . $student['phone'] . " [" . $student['reg_no'] . ']';
                    $email = $student['email']
                ?>
                    <li onclick='selectSuggestion("<?= $email ?>","suggestion_list1", "student_search_input","updateStudentButton")' class="suggestion_item"><?= $fullName ?></li>
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
