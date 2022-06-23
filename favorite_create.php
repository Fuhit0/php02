<?php
// var_dump($_GET);
// exit();

include('function.php');

$user_id = $_GET['user_id'];
$room_type = $_GET['room_type'];

$pdo = connect_to_db();

$sql = 'SELECT COUNT(*) FROM favorites_table WHERE user_id=:user_id AND room_type=:room_type';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':room_type', $room_type, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$favorites_count = $stmt->fetchColumn();
if ($favorites_count != 0) {
  // いいねされている状態
  $sql = 'DELETE FROM favorites_table WHERE user_id=:user_id AND room_type=:room_type';
} else {
  // いいねされていない状態
  $sql = 'INSERT INTO favorites_table (id, user_id, room_type, created_at) VALUES (NULL, :user_id, :room_type, now())';
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':room_type', $room_type, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:read.php");
exit();