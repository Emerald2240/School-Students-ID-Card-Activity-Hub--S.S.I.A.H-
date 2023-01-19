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

                $queryCondition = "WHERE course_name LIKE '%" . $wordsAry[$i] . "%' OR course_code LIKE '%" . $wordsAry[$i] . "%' ";

                if ($i != $wordsCount - 1) {
                    $queryCondition .= " OR ";
                }
            }
            //  }






            $orderby = " ORDER BY id asc";
            //echo $queryCondition;
            $query = "SELECT * FROM courses " . $queryCondition . $orderby . " LIMIT 0,6";
            $result = $db_handle->runQuery($query);
            if ($result) { ?>
                <?php
                foreach ($result as $course) {
                    $fullName = $course['course_name'] . " [" . $course['course_code'] . ']';
                    $courseCode = $course['course_name'];
                ?>
                    <li onclick='selectSuggestion("<?= $courseCode ?>","suggestion_list2", "course_search_input","assignToLecturerButton")' class="suggestion_item"><?= $fullName ?></li>
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
