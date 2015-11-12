<?php

// 設定ファイルと関数ファイルを読み込む
require_once('config.php');
require_once('functions.php');

// DBに接続

$dbh = connectDatabase();

// レコードの取得
$sql = "select * from tasks";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // フォームに入力されたデータの受け取り
    $title = $_POST['name'];

    // エラーチェック用の配列
    $errors = array();

    // バリデーション
    if ($title == '') {
        $errors['name'] = 'タスク名を入力してください';
    }

    if (empty($errors)) {
        $dbh = connectDatabase();

        $sql = "insert into tasks (name, created_at, updated_at) values (:name, now(), now())";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->execute();

        // index.phpに戻る
        header('Location: index.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タスク管理</title>
</head>
<body>
<h1>タスク管理アプリ</h1>
<p>
    <form action="" method="post">
        <input type="text" name="name">
        <input type="submit" value="追加">
        <span style="color:red;"><?php echo h($errors['name']) ?></span>
    </form>
</p>

<h2>未完了タスク</h2>
<ul>
<?php foreach ($tasks as $task) : ?>
<?php if ($task['status'] == 'notyet') : ?>
    <li>
               <!-- タスク完了のリンクを追記 -->
        <a href="done.php?id=<?php echo h($task['id']); ?>">[完了]</a>
        <?php echo h($task['name']); ?>

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
                    <?php echo h($task['name']); ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

</body>
</html>