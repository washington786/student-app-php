<?php

require_once("../globals/header.php");
require_once("../globals/db-con.php");

// getting the id of the student
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit();
}

// sql statement to update the student information
$sqlStatement = "SELECT * FROM students WHERE student_no=$id";
$results = mysqli_query($dbConnection, $sqlStatement);
$resultsCheck = mysqli_fetch_array($results);
// declare variables to hold input values for update
$firstName = $resultsCheck['first_name'];
$lastName = $resultsCheck['last_name'];
$email = $resultsCheck['email'];
$address = $resultsCheck['address'];
$course = $resultsCheck['course'];
$faculty = $resultsCheck['faculty'];

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $faculty = $_POST['faculty'];

    if (!$firstName) {
        $errors[] = 'Field first name is required!';
    }
    if (!$lastName) {
        $errors[] = 'Field last name is required!';
    }
    if (!$email) {
        $errors[] = 'Field email is required!';
    }
    if (!$address) {
        $errors[] = 'Field address is required!';
    }
    if (!$course) {
        $errors[] = 'Field course is required!';
    }

    if (empty($errors)) {
        $sqlUpdateStatement = "UPDATE students set firstName='$firstName', lastName='$lastName', email='$email', course='$course', faculty='$faculty', address='$address' where student_no='$id'";
        $res = mysqli_query($dbConnection, $sqlUpdateStatement);

        if ($res > 0) {
            echo 'successfully updated.......';
        } else {
            echo 'failed to update...........';
        }

        // header('Location: index.php');
        // exit();
    }
}

?>


<div class="container" style="padding:5rem 0; position:relative;">

    <a href="./index.php" class="c-icon" style="position:absolute; top:1rem; right:2rem; color:#333;">
        <i class="bi bi-x-lg c-icon" style="font-size: 2rem;"></i>
    </a>
    
    <div class="card d-flex m-auto" style="width: 40rem; height: 100%!important;">
        <div class="card-body">


            <h1 class="display-4 fs-4 text-secondary">UPDATE STUDENT DETAILS</h1>
            <span class="text-muted display-6 fs-6">please select a field to which you wish to update, and click update if done.</span>

            <!-- alert for errors -->
            <?php if (!empty($errors)) { ?>
                <div class=" alert alert-danger alert-dismissible" role="alert">
                    <?php
                    foreach ($errors as $error) { ?>
                        <div><?php echo $error ?></div>
                    <?php } ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <form class="row g-3 mt-3" action="./edit.php" method="post">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstName" value="<?php echo $firstName ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastName" value="<?php echo $lastName ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputAddress" name="email" value="<?php echo $email ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Course</label>
                    <input type="text" class="form-control" name="course" value="<?php echo $course ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label" disabled>faculty</label>
                    <input type="text" class="form-control" disabled value="<?php echo $faculty ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Faculty</label>
                    <select id="inputState" class="form-select" name="faculty" value="<?php echo $faculty ?>">
                        <option disabled selected hidden>Choose faculty..</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Health">Health</option>
                        <option value="ICT">ICT</option>
                        <option value="Commerce">Commerce</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                </div>
            </form>


        </div>
    </div>
</div>




<?php
require_once("../globals/footer.php");
?>