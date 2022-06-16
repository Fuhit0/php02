<?php
session_start();
include("function.php");
check_session_id();
// var_dump($_POST);
// exit();


// POSTデータ確認
if (
  !isset($_POST['reservation_id']) || $_POST['reservation_id']=='' ||
  !isset($_POST['user_name']) || $_POST['user_name']=='' ||
  !isset($_POST['mail']) || $_POST['mail']=='' ||
  !isset($_POST['check_in']) || $_POST['check_in']=='' ||
  !isset($_POST['check_out']) || $_POST['check_out']=='' ||
  !isset($_POST['people']) || $_POST['people']==''
) {
  exit('データが足りません');
}

// create.php
$reservation_id = $_POST['reservation_id'];
$user_name = $_POST['user_name'];
$mail = $_POST['mail'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$people = $_POST['people'];

// DB接続
$pdo = connect_to_db();

// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．

$sql = 'UPDATE reservations_table SET user_name=:user_name, mail=:mail, check_in=:check_in, check_out=:check_out, people=:people WHERE reservation_id=:reservation_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':reservation_id', $reservation_id, PDO::PARAM_STR);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':check_in', $check_in, PDO::PARAM_STR);
$stmt->bindValue(':check_out', $check_out, PDO::PARAM_STR);
$stmt->bindValue(':people', $people, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:read.php');
exit();