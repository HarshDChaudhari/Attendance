<?php 
    $date = date("Y-m-d");
    if(isset($_GET["date"])){
        $date = sanitize_input($_GET["date"]);
    }
    $school = $detail[2];
    $class = $detail[3];

    if ($class != NULL ) {
//    Class is assigned 
    
    $sql = "SELECT enrollment_number, name FROM student WHERE `school` LIKE '$school' AND `class` LIKE '$class'";

    $result = mysqli_query($conn, $sql);
    $students = array();
    while($student = mysqli_fetch_assoc($result)){
        $students[] = array($student["name"], $student["enrollment_number"]);
    }

    $tb = "$school". "_" . "$class";

    $tb = "{$school}_{$class}";
    $check = "SHOW TABLES LIKE '$tb'";
    $table_exists_result = mysqli_query($conn, $check);

    if(mysqli_num_rows($table_exists_result) > 0) {
        // Table exists, proceed with attendance retrieval
    $sql = "SELECT * FROM `$tb` WHERE DATE(date) = '$date'";
    $result = mysqli_query($conn, $sql);
    $attendance = array();
    if($att = mysqli_fetch_assoc($result)){
        $attendance = array();
        foreach($students as $stu){
            $attendance[] = $att[$stu[1]];
        }
    }

    $dates = array();
    $sql = "SELECT date FROM $tb ORDER BY date DESC";
    $result = mysqli_query($conn, $sql);
    while($dt = mysqli_fetch_assoc($result)){
        $dates[] = $dt["date"];
    }

?>


<div class="row">
     <div class="col-lg-12">
        <div class="card">
            <div>
                <div class="card-header">
                    <form action="teacher.php?page=viewAttendance" method="GET">
                        <input type="text" name="page" id="page" value="viewAttendance" hidden>
                        <label id="date" name="date" class="card-title mb-0">Date: </>           
                        <select name="date" id="date" onchange="this.form.submit()">
                            <?php
                                foreach($dates as $dt){ ?>
                                    <option value="<?php echo $dt ?>" <?php if($dt == $date){ ?>
                                        selected
                                    <?php } ?>>
                                    <?php echo $dt ?>
                                </option>
                            <?php    }
                            ?>
                        </select>
                    </form>
                </div>
            </div>
            <table class="table table-nowrap">
    <thead>
        <tr>
            <th scope="col">SR NO</th>
            <th scope="col">Enrollment Number</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 0;
        foreach($students as $st){ 
            $index += 1; ?>
            <tr>
                <th scope="row">
                    <?php echo $index; ?>
                </th>
                <td>
                    <?php echo $st[1]; ?>
                </td>
                <td>
                    <?php echo $st[0]; ?>
                </td>
                <td>
                    <?php 
                        if($attendance[$index - 1]){
                            echo "YES";
                        }else{
                            echo "NO";
                        }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
    </div>
        
        <!-- end card -->
         
    </div>
        <!-- end col -->
         
</div>

<?php
    } else {
        // Table does not exist
    ?>
        <div class="alert alert-info material-shadow" role="alert">
            No attendance data to show for the selected class. <br>
            You haven't take any attendance for this class yet <br>
            <b><a href="?page=takeAttendance" class="text-decoration-none">Take Attendance here</a></b> - check it out!
        </div>
    <?php
    }
} else {
    // Class is NULL or not assigned
?>
    <div class="alert alert-info material-shadow" role="alert">
        You cannot Take/View attendance of students at this time because you have not been assigned a class by the admin.
        Please contact the administration to have a class assigned to you.
    </div>
<?php } ?>
