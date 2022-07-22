<?php
require_once("../globals/header.php");
require_once("../globals/db-con.php");

// search
$search = $_GET['search'] ?? null;

if($search){
    $sqlStatement = "SELECT * FROM students WHERE first_name like '%$search%'";
}else{
    $sqlStatement = "SELECT * FROM students";
}


$results = mysqli_query($dbConnection, $sqlStatement);
$results_check = mysqli_num_rows($results);
?>

<section class="container" style="margin: auto; padding: 10rem 0;">
    <?php
    if ($results_check) {
        echo '<h1 class="fs-2 display-4 text-decoration-underline text-primary mb-5">2022 New Students</h1>';
    }
    ?>


    <div class="row">
        <div class="col-5">
            <a href="./add-student.php">
                <button type="button" class="btn btn-md btn-primary mb-4">Add New Student</button>
            </a>
        </div>
        <div class="col">
            <form action="index.php?search=<?php echo $search ?>">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search for student...." aria-label="Search Students" aria-describedby="button-addon2" name="search" value="<?php echo $search ?>">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">SEARCH</button>
                </div>
            </form>
        </div>
    </div>




    <?php ?>
    <table class="table">
        <?php
        if ($results_check > 0) { ?>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Physical Address</th>
                    <th scope="col">Course</th>
                    <th scope="col">Faculty</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        <?php } ?>
        <tbody>
            <?php
            if ($results_check > 0) {
                foreach ($results as $key => $students) { ?>
                    <tr>
                        <th scope="row"><?php echo $key + 1 ?></th>
                        <td><?php echo $students['first_name'] ?></td>
                        <td><?php echo $students['last_name'] ?></td>
                        <td><?php echo $students['email'] ?></td>
                        <td><?php echo $students['address'] ?></td>
                        <td><?php echo $students['course'] ?></td>
                        <td><?php echo $students['faculty'] ?></td>
                        <td>
                            <a href="./edit.php?id=<?php echo $students['student_no'] ?>" class="btn btn-sm btn-outline-primary">Edit
                            </a>

                            <!-- deleting student record button -->
                            <form action="delete.php" method="post" class="d-inline-block">
                                <input type="hidden" value="<?php echo $students['student_no'] ?>" name="student_no">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
            <?php }
            }
            ?>

        </tbody>
        <div class="mt-2">
            <?php
            if ($results_check < 0) {
                echo '<span class="text-muted display-6 fs-5 fw-bold text-danger mt-2">No new students have registered for this year!</span>';
            }
            ?>
        </div>
    </table>
</section>

<?php require_once "../globals/footer.php" ?>