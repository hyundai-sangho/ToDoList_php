<?php

$todos = [];

if (file_exists('todo.json')) {
  $json = file_get_contents('todo.json');
  $todos = json_decode($json, true);
}

?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>할 일 목록</title>
</head>

<body>
  <form action="newtodo.php" method="post">
    <input type="text" name="todo_name" placeholder="Enter your todo">
    <button>새로운 할 일</button>
  </form>
  <br>

  <?php foreach ($todos as $todoName => $todo) :  ?>

    <div style="margin-bottom: 20px;">
      <form style="display: inline-block;" action="change_status.php" method="post">
        <input type="hidden" name="todo_name" value="<?= $todoName ?>">
        <input type="checkbox" <?= $todo['completed'] ? 'checked' : '' ?>>
      </form>

      <?php echo $todoName; ?>
      <form style="display:inline-block" action="delete.php" method="post">
        <input type="hidden" name="todo_name" value="<?= $todoName ?>">
        <button>삭제</button>
      </form>
    </div>

  <?php endforeach; ?>
</body>

<script>
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach(ch => {
    ch.onclick = function() {
      this.parentNode.submit();
    }
  })
</script>

</html>