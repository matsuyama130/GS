<?php
session_start();
include('functions.php');
check_session_id();



if (

  !isset($_POST['date']) || $_POST['date'] == '' ||
  !isset($_POST['place']) || $_POST['place'] == '' ||
  !isset($_POST['area']) || $_POST['area'] == '' ||
  !isset($_POST['machine']) || $_POST['machine'] == '' ||
  !isset($_POST['tana_key']) || $_POST['tana_key'] == '' ||
  !isset($_POST['type_key']) || $_POST['type_key'] == '' ||
  !isset($_POST['gauge_name']) || $_POST['gauge_name'] == '' ||
  !isset($_POST['staff']) || $_POST['staff'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}


$date = $_POST['date'];
$place = $_POST['place'];
$area = $_POST['area'];
$machine = $_POST['machine'];
$tana_key = $_POST['tana_key'];
$type_key = $_POST['type_key'];
$gauge_name = $_POST['gauge_name'];
$staff = $_POST['staff'];
$id = $_POST['id'];

// DB接続

$pdo = connect_to_db();

//$sql = 'INSERT INTO lost_table(id, date, place, area, machine, tana_key, type_key, gauge_name, staff, created_at, updated_at) VALUES(NULL, :date, :place, :area, :machine, :staff, :tana_key, :type_key, :gauge_name, now(), now())';
$sql = "UPDATE lost_table SET date=:date, place=:place, area=:area, machine=:machine, tana_key=:tana_key, type_key=:type_key, gauge_name=:gauge_name, staff=:staff, updated_at=now() WHERE id=:id";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':place', $place, PDO::PARAM_STR);
$stmt->bindValue(':area', $area, PDO::PARAM_STR);
$stmt->bindValue(':machine', $machine, PDO::PARAM_STR);
$stmt->bindValue(':tana_key', $tana_key, PDO::PARAM_STR);
$stmt->bindValue(':type_key', $type_key, PDO::PARAM_STR);
$stmt->bindValue(':gauge_name', $gauge_name, PDO::PARAM_STR);
$stmt->bindValue(':staff', $staff, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);


try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:tool.php');
exit();


//var_dump($_FILES);
//exit();