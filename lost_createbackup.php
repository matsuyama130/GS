<?php
session_start();
include('functions.php');
check_session_id();

if (
  !isset($_POST['lost']) || $_POST['lost'] == '' ||
  !isset($_POST['date']) || $_POST['date'] == '' ||
  !isset($_POST['place']) || $_POST['place'] == '' ||
  !isset($_POST['area']) || $_POST['area'] == '' ||
  !isset($_POST['machine']) || $_POST['machine'] == '' ||
  !isset($_POST['staff']) || $_POST['staff'] == '' ||
  !isset($_POST['gauge_key']) || $_POST['gauge_key'] == '' ||
  !isset($_POST['tana_key']) || $_POST['tana_key'] == '' ||
  !isset($_POST['osu_mesu_key']) || $_POST['osu_mesu_key'] == '' ||
  !isset($_POST['type_key']) || $_POST['type_key'] == '' ||
  !isset($_POST['gauge_name']) || $_POST['gauge_name'] == '' ||
  !isset($_POST['gauge_name_jyunban']) || $_POST['gauge_name_jyunban'] == '' ||
  !isset($_POST['memo']) || $_POST['memo'] == '' 
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$lost = $_POST['lost'];
$date = $_POST['date'];
$place = $_POST['place'];
$area = $_POST['area'];
$machine = $_POST['machine'];
$staff = $_POST['staff'];
$gauge_key = $_POST['gauge_key'];
$tana_key = $_POST['tana_key'];
$osu_mesu_key = $_POST['osu_mesu_key'];
$type_key = $_POST['type_key'];
$gauge_name = $_POST['gauge_name'];
$gauge_name_jyunban = $_POST['gauge_name_jyunban'];
$memo = $_POST['memo'];

$pdo = connect_to_db();

$sql = 'INSERT INTO lost_table(id, lost, date, place, area, machine, staff, gauge_key, tana_key, osu_mesu_key, type_key, gauge_name, gauge_name_jyunban, memo, created_at, updated_at) VALUES(NULL, :lost, :date, :place, :area, :machine, :staff, :gauge_key, :tana_key, :osu_mesu_key, :type_key, :gauge_name, :gauge_name_jyunban, :memo, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lost', $lost, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':place', $place, PDO::PARAM_STR);
$stmt->bindValue(':area', $area, PDO::PARAM_STR);
$stmt->bindValue(':machine', $machine, PDO::PARAM_STR);
$stmt->bindValue(':staff', $staff, PDO::PARAM_STR);
$stmt->bindValue(':gauge_key', $gauge_key, PDO::PARAM_STR);
$stmt->bindValue(':tana_key', $tana_key, PDO::PARAM_STR);
$stmt->bindValue(':osu_mesu_key', $osu_mesu_key, PDO::PARAM_STR);
$stmt->bindValue(':type_key', $type_key, PDO::PARAM_STR);
$stmt->bindValue(':gauge_name', $gauge_name, PDO::PARAM_STR);
$stmt->bindValue(':gauge_name_jyunban', $gauge_name_jyunban, PDO::PARAM_STR);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:tool.php");
exit();


//var_dump($_FILES);
//exit();