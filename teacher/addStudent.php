<?php
if (isset($detail) and $detail[3] != NULL) { ?>
<div class="card p-4 w-50" style="margin-left: 25%">
    <form action="" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="teacher_name" placeholder="Enter Name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="enrollment_number" class="form-label">Enrollment Number</label>
            <input type="text" class="form-control" id="enrollment_number" placeholder="Enter Enrollment Number"
                name="enrollment_no" required>
        </div>
        <div class="d-flex gap-5">
            <div class="mb-3">
                <label for="class" class="form-label">class</label>
                <br>
                <input type="type" class="form-control" id="class" name="class" value="<?php echo $detail[3] ?>"
                    disabled />
            </div>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <br>
            <div>
                <input type="radio" name="gender" value="m" id="male" required>
                <label for="male">Male</label>

                <input type="radio" name="gender" value="f" id="female">
                <label for="female">Female</label>
            </div>
        </div>


        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="String" class="form-control" id="phone_number" placeholder="Enter Phone Number" name="phone_no" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
        </div>

                <!-- Default Input Image -->
                <div>
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control" type="file" id="imageFile">
        </div>

        <div class="text-center mt-4">
            <input class="btn btn-primary btn-lg" type="submit" name="student_add" value="Submit" />
        </div>
    </form>
</div>
<?php }else{?>
    <div class="alert alert-info material-shadow" role="alert">
    You <b> cannot register new students</b> at this time because you have <b> not been assigned a class </b> by the admin. <br> 
    Please contact the administration to have a class assigned to you.
</div>
     <?php }?>
<?php 
    if($_SESSION["login"] and isset($_POST["student_add"])){
        $school = $detail[2];
        $class = $detail[3];

        $tb = "$school". "_" . "$class";

        $name = sanitize_input($_POST["name"]);
        $enrollment_no = sanitize_input($_POST["enrollment_no"]);
        $class = $detail[3];
        $gender = sanitize_input($_POST["gender"]);
        $email = sanitize_input($_POST["email"]);
        $phone_no = sanitize_input($_POST["phone_no"]);
        $password = sanitize_input($_POST["password"]);
                
        $check = "SHOW TABLES LIKE '$tb'";
        $result = mysqli_query($conn, $check);
        if($result and mysqli_num_rows($result) == 1){
            $sql = "ALTER TABLE $tb ADD `$enrollment_no` BOOLEAN DEFAULT FALSE";
            if(mysqli_query($conn, $sql)){
                echo "<h3> uploaded successfully!</h3>";
            }
        }

        $sql = "INSERT INTO student (name, enrollment_number, school, class, gender, email, password, phone_no) VALUES ('$name', '$enrollment_no', '$detail[2]', '$class', '$gender', '$email', '$password', '$phone_no')";

        if(mysqli_query($conn, $sql)){
            echo "<h3> uploaded successfully!</h3>";
            echo "<script type = \"text/javascript\">
                    window.location = (\"teacher.php\")
                    </script>";
        } else {
            echo "<h3>  Failed to upload!</h3>";
        }
    }

?>
