<?php


function connect_to_db()
{
  //$dbn='mysql:dbname=lost_factory;charset=utf8mb4;port=3306;host=localhost';
  //$user = 'root';
  //$pwd = '';

  $dbn='mysql:dbname=7c1987ea464275f919a6cb839ed2df11;charset=utf8mb4;host=mysql-2.mc.lolipop.lan';
  $user = '7c1987ea464275f919a6cb839ed2df11';
  $pwd = 'Isao19860730';

  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
      echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}



// ログイン状態のチェック関数


function check_session_id()
{
  if (
    !isset($_SESSION["session_id"]) ||
    $_SESSION["session_id"] != session_id()
  ) {
    header("Location:lost_login.php");
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}
