<?php 
if($_SESSION["login"] and $_SESSION["teacher"]){
    $school = $detail[2];
    $class = $detail[3];

    $sql = "SELECT enrollment_number, name FROM student WHERE `school` LIKE '$school' AND `class` LIKE '$class'";

    $result = mysqli_query($conn, $sql);
    $students = array();
    while($student = mysqli_fetch_assoc($result)){
        $students[] = array($student["name"], $student["enrollment_number"]);
    }

    
    if(isset($_POST["attendance_submit"])){
        $tb = "$school". "_" . "$class";
        $sql = "INSERT INTO $tb (";
        $back = "(";
        $total = 0;
        foreach($students as $student){
            $en = $student[1];
            if(isset($_POST["$en"])){
                $val = TRUE;
                $total += 1;
                $sql = $sql . "`$en`, ";
                $back = $back . "$val, ";
            }
        }
        $sql = $sql . "`total`) VALUES " . $back . "$total)";
        $check = "SHOW TABLES LIKE '$tb'";
        $result = mysqli_query($conn, $check);
        if($result and mysqli_num_rows($result) == 1){
            $newSQL = "SELECT date FROM `$tb` WHERE date LIKE CURRENT_DATE";
    
            $result = mysqli_query($conn, $newSQL);

            if(mysqli_num_rows($result) == 0){
                mysqli_query($conn, $sql);
                echo "<script type='text/javascript'>
                        window.location = 'teacher.php';
                      </script>";
            }
            else{
                echo "<div class='mx-5 alert alert-success material-shadow' role='alert'>
    Attendance already taken for today!
</div>";
            }

        }
        else{
            $sql1 = "CREATE TABLE `$tb` (`date` DATE DEFAULT CURRENT_DATE PRIMARY KEY, ";
            foreach($students as $student){
                $en = $student[1];
                $sql1 = $sql1 . "`$en` BOOLEAN DEFAULT FALSE, ";
            }
            $sql1 = $sql1 . "`total` int NOT NULL)";
            echo $sql1;
            if(mysqli_query($conn, $sql1)){
                echo "Table created";
                if(mysqli_query($conn, $sql)){
                    echo "<script type='text/javascript'>
                    window.location = 'teacher.php';
                    </script>";
                }
            }
        }
    }
?>
<?php if ($detail[3] != NULL) { ?>
    <?php if (count($students) > 0) { ?>
<div class="card p-4 m-5">
    <h1 class="text-center fs-1">Student Table</h1>
    <hr>
    <form action="" method="POST">
    <table class="table table-nowrap mb-0">
        <thead>
            <tr>
                <th scope="col">Sr.No.</th>
                <th scope="col">Enrollment No</th>
                <th scope="col">Student Name</th>
                <th scope="col">Present</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $index = 0;
            foreach($students as $student){ 
                $index += 1?>
            <tr>
                <td><?php echo $index; ?></td>
                <td><?php echo $student[1]; ?></td>
                <td><?php echo $student[0]; ?></td>
                <th scope="row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=""
                            id="activetableCheck01" name="<?php echo $student[1] ?>" checked>
                        <label class="form-check-label" for="activetableCheck01"
                            cursor="pointer"></label>
                    </div>
                </th>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="text-center">
        <input class="btn btn-primary btn-lg mt-3" type="submit" name="attendance_submit" value="Submit" />
    </div>
</form>
</div>
<?php } else { ?>
        <div class="alert alert-warning material-shadow" role="alert">
            No students found in the class. Please ensure that students are enrolled in the class. <br>
            You can<strong> Register New Student </strong>  <br><b><a href="?page=addStudent" class="text-decoration-none">Add New Student here</a></b> -check it out!
        </div>
    <?php } ?>
<?php }else{?>
    <div class="alert alert-info material-shadow" role="alert">
    You <b>cannot take attendance of students</b> at this time because you have <b> not been assigned a class </b> by the admin. <br>
    Please contact the administration to have a class assigned to you.
</div>
     <?php }?>
    
<?php 
}
?>