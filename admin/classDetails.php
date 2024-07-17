<?php
    if($_SESSION["login"] and $_SESSION["admin"]){
        $school = $detail[2];

        $sql = "SELECT * FROM class WHERE school LIKE '$school'";

        $result = mysqli_query($conn, $sql);
        $classes = array();
        while($class = mysqli_fetch_assoc($result)){
            $classes[] = array($class["name"], $class["teacher_name"], $class["school"]);
        }
    }
?>


<?php if (count($classes) > 0): ?>
    <div class="card">
    <!-- Table is displayed only if there is data -->
    <table class="table table-hover table-nowrap mb-0">
        <thead>
            <tr>
                <th scope="col">sr no.</th>
                <th scope="col">Class Name</th>
                <th scope="col">Teacher Name</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $sr = 1;
        foreach($classes as $class){
            echo "<tr>";
            echo "<td>".$sr."</td>";
            echo "<td>".$class[0]."</td>";
            echo "<td>".$class[1]."</td>";
            echo "</tr>";
            $sr++;
        }     
        ?>
        </tbody>
    </table>
<?php else: ?>
    <!-- Message is displayed if there is no data -->
    <div class="alert border-0 alert-danger material-shadow" role="alert">
    <strong>No Classes</strong> found for this school.
        Please <strong>Allocate New Class </strong>  <br> <a href="?page=classAllocation">Allocate Class here</a> -check it out!
    </div>
<?php endif; ?>
</div>
