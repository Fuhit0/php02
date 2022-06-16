<?php
session_start();
include("function.php");
check_session_id();

// DB接続
$pdo = connect_to_db();

$reservation_id = $_GET['id'];

$sql = 'DELETE FROM reservations_table WHERE reservation_id=:reservation_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':reservation_id', $reservation_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:read.php");
exit();