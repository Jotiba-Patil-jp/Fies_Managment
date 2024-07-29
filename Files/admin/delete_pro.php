<?php
session_start();

if (isset($_SESSION['user_email'])) {
    echo "<script>window.open('index1.php?view_profile1', '_self');</script>";
    exit();
} elseif (!isset($_SESSION['user_email1'])) {
    echo "<script>window.open('../index.php', '_self');</script>";
    exit();
} else {
    include("includes/connection.php");

    if (isset($_GET['delete_pro'])) {
        $delete_id = $_GET['delete_pro'];

        // Check if confirmation parameter is set
        if (isset($_GET['confirm_delete']) && $_GET['confirm_delete'] == 'true') {
            $delete_pro = "DELETE FROM student WHERE student_id = '$delete_id'";
            $run_delete = mysqli_query($con, $delete_pro);

            if ($run_delete) {
                echo "<script>alert('Student has been deleted');</script>";
            } else {
                echo "<script>alert('Error deleting student');</script>";
            }
            // Redirect to view_students after deletion
            echo '<META HTTP-EQUIV="Refresh" Content="0.000001; URL=index.php?view_students">';
            exit();
        } else {
            // Confirm deletion with JavaScript
            echo "
            <script>
                if (confirm('Are you sure you want to delete this student?')) {
                    window.location.href = 'index.php?delete_pro={$delete_id}&confirm_delete=true';
                } else {
                    window.location.href = 'view_students.php?view_students';
				
                }
            </script>
            ";
            exit();
        }
    }
}
?>
