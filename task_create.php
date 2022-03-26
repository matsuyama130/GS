<?php
session_start();
include('functions.php');
check_session_id();

if (
  !isset($_POST['date']) || $_POST['date'] == '' ||
  !isset($_POST['place_a']) || $_POST['place_a'] == '' ||
  !isset($_POST['area_a']) || $_POST['area_a'] == '' ||
  !isset($_POST['machine_a']) || $_POST['machine_a'] == '' ||
  !isset($_POST['place_b']) || $_POST['place_b'] == '' ||
  !isset($_POST['area_b']) || $_POST['area_b'] == '' ||
  !isset($_POST['machine_b']) || $_POST['machine_b'] == '' ||
  !isset($_POST['staff']) || $_POST['staff'] == '' ||
    !isset($_POST['type_key']) || $_POST['type_key'] == '' ||
  !isset($_POST['gauge_name']) || $_POST['gauge_name'] == '' 
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$date = $_POST['date'];
$place_a = $_POST['place_a'];
$area_a = $_POST['area_a'];
$machine_a = $_POST['machine_a'];
$place_b = $_POST['place_b'];
$area_b = $_POST['area_b'];
$machine_b = $_POST['machine_b'];
$staff = $_POST['staff'];
$type_key = $_POST['type_key'];
$gauge_name = $_POST['gauge_name'];


$pdo = connect_to_db();

$sql = 'INSERT INTO task_table(id, date, place_a, area_a, machine_a, place_b, area_b, machine_b, staff, type_key, gauge_name, created_at, updated_at) VALUES(NULL, :date, :place_a, :area_a, :machine_a, :place_b, :area_b, :machine_b, :staff, :type_key, :gauge_name, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':place_a', $place_a, PDO::PARAM_STR);
$stmt->bindValue(':area_a', $area_a, PDO::PARAM_STR);
$stmt->bindValue(':machine_a', $machine_a, PDO::PARAM_STR);
$stmt->bindValue(':place_b', $place_b, PDO::PARAM_STR);
$stmt->bindValue(':area_b', $area_b, PDO::PARAM_STR);
$stmt->bindValue(':machine_b', $machine_b, PDO::PARAM_STR);
$stmt->bindValue(':staff', $staff, PDO::PARAM_STR);
$stmt->bindValue(':type_key', $type_key, PDO::PARAM_STR);
$stmt->bindValue(':gauge_name', $gauge_name, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:task.php");
exit();


//var_dump($_FILES);
//exit();