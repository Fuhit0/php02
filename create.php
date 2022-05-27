<?php
// var_dump($_POST);
// exit();


// POSTデータ確認
if (
  !isset($_POST['name']) || $_POST['name']=='' ||
  !isset($_POST['email']) || $_POST['email']=='' ||
  !isset($_POST['checkin']) || $_POST['checkin']=='' ||
  !isset($_POST['checkout']) || $_POST['checkout']=='' ||
  !isset($_POST['people']) || $_POST['people']=='' ||
  !isset($_POST['roomtype']) || $_POST['roomtype']==''
) {
  exit('データが足りません');
}

// create.php

$name = $_POST['name'];
$email = $_POST['email'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$people = $_POST['people'];
$roomtype = $_POST['roomtype'];


// DB接続

// 各種項目設定
$dbn ='mysql:dbname=gsacf_d11_10;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．


// SQL作成&実行

// SQL作成&実行
$sql = 'INSERT INTO reservations_table (reservation_id, created_at, user_name, mail, check_in, check_out, people, room_type) VALUES (NULL, now(), :name, :email, :checkin, :checkout, :people, :roomtype )';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':checkin', $checkin, PDO::PARAM_STR);
$stmt->bindValue(':checkout', $checkout, PDO::PARAM_STR);
$stmt->bindValue(':people', $people, PDO::PARAM_STR);
$stmt->bindValue(':roomtype', $roomtype, PDO::PARAM_STR);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:input.php');
exit();