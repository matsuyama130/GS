<?php
//var_dump
include('functions.php');

//$user_id = $_GET['user_id'];
$task_id = $_GET['task_id'];

$pdo = connect_to_db();


$sql = 'SELECT COUNT(*) FROM check_table WHERE user_id=:user_id AND task_id=:task_id';

$stmt = $pdo->prepare($sql);
//$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':task_id', $task_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$check_count=$stmt->fetchColumn();
//var_dump($check_count);
//exit();


if ($check_count!= 0) {
  // いいねされている状態
  $sql = 'DELETE FROM check_table WHERE user_id=:user_id AND task_id=:task_id';
} else {
  // いいねされていない状態
  $sql = 'INSERT INTO check_table (id, user_id, task_id, created_at) VALUES (NULL, :user_id, :task_id, sysdate())';
}

$stmt = $pdo->prepare($sql);
//$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':task_id', $task_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:index.php");
exit();