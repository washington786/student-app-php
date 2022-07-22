<?php

require_once("../globals/db-con.php");

$id = $_POST['student_no'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

$sqlStatement = "DELETE FROM students WHERE student_no = $id";
$results = mysqli_query($dbConnection, $sqlStatement);
// $resultsCheck = mysqli_num_rows($results);

if ($results > 0) { 

    header("Location: index.php");
    exit();

}
