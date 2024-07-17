<?php
if ($_SESSION["login"]) {
    $school = $detail[2];
    $class = $detail[3];
    $tb = "$school" . "_" . "$class";

    $total = 0;
    $check = "SHOW TABLES LIKE '$tb'";
    $table_exists_result = mysqli_query($conn, $check);
    if (mysqli_num_rows($table_exists_result) > 0) {
        // Table exists, proceed with attendance retrieval
        $sql = "SELECT date FROM $tb";
        $total = mysqli_num_rows(mysqli_query($conn, $sql));

        $sql = "SELECT date FROM $tb WHERE `$detail[1]` = 1";
        $present = mysqli_num_rows(mysqli_query($conn, $sql));

?>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Pie Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" class="chartjs-chart" data-colors='["--vz-success", "--vz-light"]'></canvas>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    <?php } else {
    ?>
        <div class="alert alert-info material-shadow" role="alert">
            You Don't have any attendance
        </div>
<?php }
} ?>