<?php
session_start();
include("function.php");
check_session_id();
// DB接続
$pdo = connect_to_db();


// SQL作成&実行①
$Uname = $_SESSION["username"];

$sql1 = 'SELECT 
reservation_id,
user_name,
mail,
check_in,
check_out,
people,
room_type
FROM 
reservations_table
where
user_name = "'. $Uname .'" ';
$stmt1 = $pdo->prepare($sql1);

try {
  $status1 = $stmt1->execute();
} catch (PDOException $e) {
  echo json_encode(["sql1 error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
$user_id = $_SESSION['user_id'];

$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$output1 = "";
foreach ($result1 as $record1) {
  $output1 .= "
    <tr>
      <td>{$record1["user_name"]}</td>
      <td>{$record1["mail"]}</td>
      <td>{$record1["check_in"]}</td>
      <td>{$record1["check_out"]}</td>
      <td>{$record1["people"]}</td>
      <td>{$record1["room_type"]}</td>
      <td>
        <a href='edit.php?id={$record1["reservation_id"]}'>ちょっと変更</a>
      </td>
      <td>
        <a href='delete.php?id={$record1["reservation_id"]}'>やっぱやめる</a>
      </td>
      <td>
        <a href='favorite_create.php?user_id={$user_id}&room_type={$record1["room_type"]}'>気に入った</a>
      </td>
    </tr>
  ";
}

// SQL作成&実行②

$sql2 = 'SELECT
	recommed.room_type
FROM
	(SELECT DISTINCT
		room_type
	FROM
		reservations_table
	INNER JOIN
		(SELECT DISTINCT
			user_name
		FROM
			reservations_table
		INNER JOIN
			(SELECT DISTINCT
				room_type
			FROM
				reservations_table
			WHERE
				user_name = "'. $Uname .'") as myreservations
		ON
			reservations_table.room_type = myreservations.room_type
		WHERE
			user_name <>"'. $Uname .'") as others
	ON
		reservations_table.user_name = others.user_name) as recommed
LEFT OUTER JOIN
	(SELECT DISTINCT
		room_type
	FROM
		reservations_table
	WHERE
		user_name = "'. $Uname .'") as myreservations2
ON
	recommed.room_type = myreservations2.room_type
WHERE
myreservations2.room_type is null';
$stmt2 = $pdo->prepare($sql2);

try {
  $status2 = $stmt2->execute();
} catch (PDOException $e) {
  echo json_encode(["sql2 error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理

$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$output2 = "";
foreach ($result2 as $record2) {
  $output2 .= "
    <tr>
      <td>{$record2["room_type"]}</td>
    </tr>
  ";
}



?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>予約履歴</title>
</head>

<body>
  <fieldset>
    <legend>予約履歴</legend>
    <p>お帰りなさいませ、<?=$_SESSION["username"]?>さま</p>
    <a href="input.php">予約画面</a>
    <a href="logout.php">一旦現実に戻る</a>
    <table border="1">
      <thead>
        <tr>
          <th>予約者名</th>
          <th>メールアドレス</th>
          <th>チェックイン日</th>
          <th>チェックアウト日</th>
          <th>人数</th>
          <th>お部屋タイプ</th>
          <th>予約変更</th>
          <th>予約キャンセル</th>
          <th>お気に入り登録</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
            <?= $output1 ?>
      </tbody>
    </table>
  </fieldset>
  <fieldset>
    <legend>あなたへのおススメ</legend>
    <table>
      <thead>
        <tr>
          <th>あなたと同じ部屋を予約された方はこんなお部屋にも泊まっています</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
            <?= $output2 ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>