<?php
require_once('config/connect.php');
require_once('functions/functions.php');

echo '<pre>';

// print_r(getStaffsMachine(1));

// print_r(getJobFromId(1));

// print_r(getActiveTaskForStaff(1));

// print_r(getAllJobEntriesForStaff(1));

// print_r(getAllAttendanceTasksForStaff(1));

// print_r(getAllSchoolFeeTasksForStaff(1));

// print_r(getAllDepartmentalFeeTasksForStaff(1));

// print_r(getAllFacultyFeeTasksForStaff(1));

// print_r(getAllStudentsScannedPerLecturer(1));

// echo getGenderCount(getAllStudentsScannedPerLecturer(1), 'Female');

// echo getEntryValidity(getAllJobEntriesForStaff(1), false);

// print_r(getLatestJobEntryFromStudentForStaff(8, 1));

// print_r(getActiveJobForStaff(1));

// print_r(divideJobEntriesIntoCountsPerDay(1));

// print_r(divideStaffAttendanceTasksIntoTwelveMonths(1));

// print_r(divideStaffDepartmentalFeeTasksIntoTwelveMonths(1));

// print_r(divideStaffFacultyFeeTasksIntoTwelveMonths(1));

print_r(divideStaffSchoolFeeTasksIntoTwelveMonths(1));