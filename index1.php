<?php

session_start();
require_once('config.php');
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = $_POST['name'];
  $errors = array();

  // バリデーション
  if ($name == '')
  {
    $errors['name'] = 'タスクが未入力です';
  }

  // バリデーション突破後
  if (empty($errors))
  {
    $dbh = connectDatabase();//dbhは一度呼び出せば大丈夫。
    $sql = "insert into tasks (name, created_at, updated_at) values (:name, now(), now())";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":name", $name);//コマンドを入力した状態
    $stmt->execute();//実行する状態。

    $row = $stmt->fetch();
    // var_dump($row);返り値が無いので値は帰ってこないよー。
  }

}


// echo h($post_id['id'] = $_GET['id'] && $user_id = $_SESSION['id']);

// if ($_SERVER['REQUEST_METHOD'] == 'POST')
// {
//   $name = $_SESSION['name'];
//   $message = $_POST['message'];
//   $errors = array();

//   // バリデーション
//   if ($message == '')
//   {
//     $errors['message'] = 'メッセージが未入力です';
//   }

//   // バリデーション突破後
//   if (empty($errors))
//   {
//     $dbh = connectDatabase();
//     $sql = "insert into posts (name, message, created_at, updated_at, user_id) values
//             (:name, :message, now(), now(), :user_id)";
//     $stmt = $dbh->prepare($sql);
//     $stmt->bindParam(":name", $name);
//     $stmt->bindParam(":message", $message);
//     $stmt->bindParam(":user_id", $_SESSION['id']);
//     $stmt->execute();

//     //indexに戻る
//     header('Location: index.php');
//     exit;

//   }


// }








?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>タスク管理アプリ(編集削除機能アリ)</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>タスク管理アプリ(編集削除機能アリ)</h1>
    <form action="" method="post">
      <textarea name="name" cols="30" rows="1"></textarea>
      <input class="btn" type="submit" value="追加">
        <?php if ($errors['name']) : ?>
          <span style="color:red;">
            <?php echo h($errors['name']) ?>
          </span>
        <?php endif ?>
    </form>
    <h2>未完了タスク</h2>
    <ul>
    <?php foreach ($tasks as $task) : ?>
    <?php if ($task['status'] == 'notyet') : ?>
        <li>
            <!-- タスク完了のリンクを追記 -->
            <a href="done.php?id=<?php echo h($task['id']); ?>">[完了]</a>
            <?php echo h($task['title']); ?>
        </li>
    <?php endif; ?>
    <?php endforeach; ?>
    </ul>
    <hr>
    <h2>完了したタスク</h2>
      <ul>
      <?php foreach ($tasks as $task) : ?>
          <?php if ($task['status'] == 'done') : ?>
              <li>
                  <?php echo h($task['title']); ?>
              </li>
          <?php endif; ?>
      <?php endforeach; ?>
      </ul>
</body>
</html>