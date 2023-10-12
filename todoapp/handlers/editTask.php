<?php
session_start();
include("../database/connect.php");

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $edit_query = "SELECT * FROM task WHERE id='$taskId'";
    $edit_query_run = mysqli_query($con, $edit_query);

    if (mysqli_num_rows($edit_query_run) > 0) {
        $row = mysqli_fetch_assoc($edit_query_run);
        $task = $row['content'];
        $id = $row['id'];
    } else {
        $task = "Unknown";
    }
}

if (isset($_POST['update'])) {
    $newContent = $_POST['content'];
    $update_query = "UPDATE task SET content='$newContent' WHERE id='$taskId'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        $_SESSION['updated'] = "Task $id Updated Successfully";
    } else {
        $_SESSION['error'] = "Something Went Wrong";
        header("location:editTask.php");
    }
    header("location:../index.php");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container p-2 my-5 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card text-center">
                <div class="card-header mb-2">
                    <h3>Edit Task</h3>
                </div>
                <div class="card-body shadow text-center">
                    <?php if (isset($_SESSION['updated'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_SESSION['updated'] ?>
                        </div>
                        <?php unset($_SESSION['updated']); ?>
                    <?php } ?>
                    <form action="" method="POST">
                        <div class="form-group text-center">
                            <label class="mb-3" for="content">Task Name</label>
                            <div class="mb-3">
                                <input type="text" name="content" class="form-control" id="content" placeholder="Name" value="<?= $task ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" value="Update" class="btn btn-primary form-control col-md-4">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>