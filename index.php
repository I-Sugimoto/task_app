<?php

// require_once('config.php');
// require_once('functions.php');

// session_start();

// if (empty($_SESSION['id']))
// {
//   header('Location: login.php');
//   exit;
// }

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
      <textarea name="message" cols="30" rows="1"></textarea>
      <input class="btn" type="submit" value="追加">
    </form>
    <h2>未完了タスク</h2>
      <ul>
        <li>
            <a href="done.php?id=75">[完了]</a>
            宿題        <a href="edit.php?id=75">[編集]</a>
            <a href="delete.php?id=75">[削除]</a>
        </li>
      </ul>
    <hr>
    <h2>完了したタスク</h2>
    <ul>
      <li>
            test3
      </li>
      <li>
            ぎゅg
      </li>
    </ul>
  </body>
</html>
