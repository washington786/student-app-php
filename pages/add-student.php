<?php
session_start();
// header
require_once("../globals/header.php");

// database connection file
require_once("../globals/db-con.php");

// an array to hold errors of inputs
$errors = [];

// declare variables that will be referenced when the form is refreshed to still be in the input field
$firstName = '';
$lastName = '';
$email = '';
$address = '';
$course = '';
$faculty = '';

// reading/getting values from the form using post method
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
    if (!$faculty) {
        $errors[] = 'Field faculty is required!';
    }

    // make an insert when the errors array is empty
    // query statements 
    if (empty($errors)) {
        $sql_statement = "INSERT INTO students(first_name,last_name,email,address,course,faculty) 
                    VALUES ('$firstName','$lastName','$email','$address','$course','$faculty')";
        $query_results = mysqli_query($dbConnection, $sql_statement);
        // $resultsCheck=mysqli_num_rows($query_results);

        header('Location: index.php');
        mysqli_close($dbConnection);
    }
}
?>


<section class="container m-auto" style="padding:5rem 0; position:relative;">

    <a href="./index.php" class="c-icon" style="position:absolute; top:1rem; right:2rem; color:#333;">
        <i class="bi bi-x-lg c-icon" style="font-size: 2rem;"></i>
    </a>

    <div class="card d-flex m-auto" style="width: 40rem; height: 100%!important;">
        <div class="card-body">

            <h1 class="display-4 fs-4 text-secondary">Add New Student</h1>
            <span class="text-muted display-6 fs-6">please fill all fields to add a new student.</span>

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

            <form class="row g-3 mt-5" action="./add-student.php" method="post">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstName" placeholder="Dan" value="<?php echo $firstName?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastName" placeholder="Lamont" value="<?php echo $lastName?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputAddress" placeholder="example@gmail.com" name="email" value="<?php echo $email?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" placeholder="3rd Str,Ladine, Polokwane" name="address" value="<?php echo $address?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Course</label>
                    <input type="text" class="form-control" placeholder="Computer Science" name="course" value="<?php echo $course?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Faculty</label>
                    <select id="inputState" class="form-select" name="faculty" value="<?php echo $faculty?>" required>
                        <option disabled selected hidden>Choose faculty..</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Health">Health</option>
                        <option value="ICT">ICT</option>
                        <option value="Commerce">Commerce</option>
                    </select>
                </div>
                <!-- <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div> -->

                <div class="col-12">
                    <button type="submit" class="btn btn-md btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

</section>

<?php require_once "../globals/footer.php" ?>