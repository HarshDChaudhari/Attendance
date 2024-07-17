<?php 
    if($_SESSION["login"] and $_SESSION["teacher"]){
        $school = $detail[2];
        $class = $detail[3];

        $sql = "SELECT * FROM student WHERE `school` LIKE '$school' AND `class` LIKE '$class'";

        $result = mysqli_query($conn, $sql);
        $students = array();
        while($student = mysqli_fetch_assoc($result)){
            $students[] = array($student["name"], $student["enrollment_number"], $student["school"], $student["class"], $student["gender"], $student["email"], $student["phone_no"]);
        }

    }
?>
<!-- Hoverable Rows -->
<?php if (mysqli_num_rows($result) > 0): ?>

<div class="card">
<table class="table table-hover table-nowrap mb-0 ">
    <thead>
        <tr>
            <th scope="col">sr no.</th>
            <th scope="col">Enrollment No.</th>
            <th scope="col">Name</th>
            <th scope="col">Class</th>
            <th scope="col">Email</th>
            <th scope="col">Contact Number</th>
        </tr>
    </thead>
    <?php 
    $sr = 1;
        if(mysqli_num_rows($result) > 0){
            foreach($students as $student){
                echo "<tr>";
                echo "<td>".$sr."</td>";
                echo "<td>".$student[1]."</td>";
                echo "<td>".$student[0]."</td>";
                echo "<td>".$student[3]."</td>";
                echo "<td>".$student[5]."</td>";
                echo "<td>".$student[6]."</td>";
                echo "</tr>";
                $sr++;
            }     
        }else{
            echo "<tr><td colspan='5'>No Data Found</td></tr>";
        }
    ?>
</table>
<?php else: ?>
    <!-- Message is displayed if there is no data -->
    <div class="alert border-0 alert-danger material-shadow" role="alert">
    <strong>No Student</strong> found Under Your Class.
        Please <strong>Register New Student </strong>  <br> <b> <a href="?page=addStudent" class="text-decoration-none">Add New Student here</a></b> -check it out!
    </div>
<?php endif; ?>
</div>