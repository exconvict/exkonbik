<?php
  $errors = "";


  $db = mysqli_connect('localhost', 'root', '', 'todoapp');

  if (isset($_POST['submit'])) {
    $task = $_POST['task'];
      if (empty($task)){
        $errors = " Fill in the task";
      }else {
        mysqli_query($db, "INSERT INTO tasks (task) VALUES('$task')");
        header('location: index.php');
      }
  }

  if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
    header('location: index.php');
  }


  $tasks = mysqli_query($db, "SELECT * FROM tasks");

?>

<!DOCTYPE html>
<html>
<head>
  <title>To-Do List Application</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class ="heading">
      <h2>To-Do List Application</h2>
    </div>

    <form method="POST" action="index.php">
      <?php if (isset($errors)) { ?>
        <p><?php echo $errors;  ?></p>
      <?php }  ?>

      <input type="text" name="task" class="task_input">
      <button type="submit" class="task_btn" name="submit">Add Task </button>
    </form>

    <table>
      <thead>
        <tr>
            <th>Number</th>
            <th>Task</th>
            <th>Action</th>
          </tr>
        </thead>


        <tbody>

    <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
           <tr>
            <td><center><?php echo $i;  ?></center></td>
            <td class="task"><?php echo $row['task']; ?></td>
            <td class="delete">
              <a href="index.php?del_task=<?php echo $row['id']; ?>">X</a>
            </td>
          </tr>

    <?php $i++; } ?>

      </tbody>


    </table>

  </body>
</html>
