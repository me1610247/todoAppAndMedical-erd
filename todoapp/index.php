<?php
session_start();
include("database/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Todo App Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container mt-3">
    <div class="row">
        <h2 class="text-center">Todo App</h2>
        <div class="col-6 mx-auto">
            <form action="handlers/storeTask.php" method="POST" class="form border p-2 my-3 mb-5">
                <?php
                if(isset($_SESSION['success'])){
                ?>
                <div class="alert alert-success text-center">
                    <?= $_SESSION['success']; ?>
                </div>
                <?php 
                }
                unset($_SESSION['success']);
                ?>
                <?php
                if(isset($_SESSION['notexists'])){
                ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['notexists']; ?>
                </div>
                <?php 
                }
                unset($_SESSION['notexists']);
                ?>
                <?php
                if(isset($_SESSION['updated'])){
                ?>
                <div class="alert alert-success text-center">
                    <?= $_SESSION['updated']; ?>
                </div>
                <?php 
                }
                unset($_SESSION['updated']);
                ?>
                <?php
                if(isset($_SESSION['delete'])){
                ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['delete']; ?>
                </div>
                <?php 
                }
                unset($_SESSION['delete']);
                ?>
                <?php
                if(isset($_SESSION['error'])){
                ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php 
                }
                unset($_SESSION['error']);
                ?>
                <input type="text" name="content" placeholder="Enter The Task Name" class="form-control border border-success my-3">
                <input type="submit" value="Add" class="form-control btn btn-primary my-3">
            </form>
        </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>TASK NO.</th>
        <th>TASK ID</th>
        <th>TASK NAME</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $tasks="SELECT * FROM task";
        $tasks_run=mysqli_query($con,$tasks);
        if(mysqli_num_rows($tasks_run)>0){
            foreach($tasks_run as $key=> $task){
                $taskId = $task['id'];
                $edit_query = "SELECT * FROM task WHERE id='$taskId'";
                $edit_query_run = mysqli_query($con, $edit_query);

                if (mysqli_num_rows($edit_query_run) > 0) {
                    $row = mysqli_fetch_assoc($edit_query_run);
                    $originalContent = $row['content'];
                } else {
                    $originalContent = "";
                }
        ?>
      <tr>
        <td><?= $key+1?></td>
        <td><?= $task['id']?></td>
        <td>
            <?= $task['content'] ?>
            <?php if ($task['content'] !== $originalContent) { ?>
                <span class="bg-info text-dark">Edited</span>
            <?php } ?>
        </td>
        <td>
            <a href="handlers/deleteTask.php?id=<?= $task['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            <a href="handlers/editTask.php?id=<?= $task['id'] ?>" class="btn btn-info text-white bg=-info">Edit</a>
        </td>
      </tr>
      <?php 
            }
        }
      ?>
    </tbody>
  </table>
</div>
</div>

</body>
</html>