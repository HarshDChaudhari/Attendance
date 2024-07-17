<?php 
    if($_SESSION["login"] and $_SESSION["admin"]){
        $school = $detail[2];

        $sql = "SELECT name FROM teacher WHERE school LIKE '$school' AND class IS NULL";

        $result = mysqli_query($conn, $sql);
        $teacher = array();
        while($row = mysqli_fetch_assoc($result)){
            $teacher[] = $row["name"];
        }
    }
?>
    <?php if(!count($teacher) > 0): ?>
        <!-- Warning message is displayed if there are unallocated teachers -->
        <div class="alert alert-warning" role="alert">
        There are currently<strong> No Teachers </strong> available to be allocated to classes.
        Please <strong>register new Teacher </strong>  <br> <b><a href="?page=addTeacher" class="text-decoration-none">Add New Teacher here</a></b> -check it out!
        </div>
    <?php endif; ?>

<div class="card p-4 m-5 ">
    <form action="" method="POST">
                            

                            <div class="mb-3 ">
                                <div class="">
                                <label for="teacher_name" class="form-label ">Teacher Name: </label>
                                <select name="teacher_name" id="teacher_name " style="width: 184px" class="m-2">
                                    <option value="SELECT">SELECT</option>
                                    <?php 
                                        foreach($teacher as $item){
                                    ?>
                                        <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                            </div>

                            <div class="d-flex gap-5 ">
                                <div class="mb-3">
                                    <label for="std" class="form-label " >Standard: </label>
                                    
                                    <select name="std" id="std" style="width: 50px" class="m-2">
                                        <?php 
                                            for($x = 1; $x < 13; $x++){
                                        ?>
                                        <option value="<?php echo $x ?>"><?php echo $x ?></option>
                                        <?php } ?>

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="div" class="form-label">Division: </label>
                                    
                                    <select name="div" id="div" style="width: 50px" class="m-2">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>


                            <div class="text-center">
                                <input class="btn btn-primary btn-md" type="submit" name="class_add" value="Allocate Class" <?php echo count($teacher) === 0 ? 'disabled' : ''; ?>/>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

<?php 
    if($_SESSION["login"] and isset($_POST["class_add"])){
        $teacher_name = sanitize_input($_POST["teacher_name"]);
        $std = sanitize_input($_POST["std"]);
        $div = sanitize_input($_POST["div"]);
        $class = $std . "_" . $div;

        $sql = "INSERT INTO class (name, teacher_name, school) VALUES ('$class', '$teacher_name', '$school')";

        mysqli_query($conn, $sql);
        
        $sql = "UPDATE teacher SET class = '$class' WHERE name = '$teacher_name'";
        if (mysqli_query($conn, $sql)) {
            echo "<h3>Class allocated successfully!</h3>";
            echo "<script type = \"text/javascript\">
                        window.location = (\"admin.php\")
                        </script>";
        } else {
            echo "<h3>Failed to allocate class!</h3>";
        }
    }
?>