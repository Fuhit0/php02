<?php
session_start();
include("function.php");
check_session_id();

// DB接続
$pdo = connect_to_db();

$sql1 = 'SELECT COUNT(id) as favorite_count FROM favorites_table WHERE room_type = "スタンダードダブルルーム"';
$stmt1 = $pdo->query($sql1);
$StD = $stmt1->fetch(PDO::FETCH_ASSOC);
// var_dump($StD);
// exit();

$sql2 = 'SELECT COUNT(id) as favorite_count FROM favorites_table WHERE room_type = "ラージダブルルーム"';
$stmt2 = $pdo->query($sql2);
$LgD = $stmt2->fetch(PDO::FETCH_ASSOC);

$sql3 = 'SELECT COUNT(id) as favorite_count FROM favorites_table WHERE room_type = "スーペリアダブルルーム"';
$stmt3 = $pdo->query($sql3);
$SpD = $stmt3->fetch(PDO::FETCH_ASSOC);

$sql4 = 'SELECT COUNT(id) as favorite_count FROM favorites_table WHERE room_type = "スタンダードスタジオ"';
$stmt4 = $pdo->query($sql4);
$StS = $stmt4->fetch(PDO::FETCH_ASSOC);

$sql5 = 'SELECT COUNT(id) as favorite_count FROM favorites_table WHERE room_type = "デラックススタジオ"';
$stmt5 = $pdo->query($sql5);
$DxS = $stmt5->fetch(PDO::FETCH_ASSOC);

$sql6 = 'SELECT COUNT(id) as favorite_count FROM favorites_table WHERE room_type = "スーペリアスタジオ"';
$stmt6 = $pdo->query($sql6);
$SpS = $stmt6->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>予約画面</title>
</head>

<body>
<div>
  <a href="read.php">予約履歴</a>
  <a href="logout.php">一旦現実に戻る</a>
</div>
<form class="contact-form" action="create.php" method="POST">
  <p>ご予約情報をご入力ください</p>
  <div class="item">
    <label class="label" for="name">名前</label>
    <input id="name" type="text" name="name" value=<?=$_SESSION["username"]?>>
  </div>
  <div class="item">
    <label class="label" for="e-mail">メールアドレス</label>
    <input id="e-mail" type="email" name="email">
  </div>
    <div class="item">
    <label class="label" for="checkin">チェックイン日</label>
    <input id="checkin" type="date" name="checkin">
  </div>
    </div>
    <div class="item">
    <label class="label" for="checkout">チェックアウト日</label>
    <input id="checkout" type="date" name="checkout">
  </div>
  <div class="item">
    <p class="label">ご宿泊人数</p><br><br>
    <div class="radio-group">
      <label><input type="radio" name="people" value="1">1</label><br>
      <label><input type="radio" name="people" value="2">2</label><br>
      <label><input type="radio" name="people" value="3">3</label><br>
      <label><input type="radio" name="people" value="4">4</label><br>
      <label><input type="radio" name="people" value="5">5</label><br>
      <label><input type="radio" name="people" value="6">6</label>
    </div>
  <div class="item">
    <p class="label">ご希望のお部屋タイプ</p><br><br>
    <div class="radio-group">
      <label><input type="radio" name="roomtype" value="スタンダードダブルルーム">スタンダードダブル　　　★みんなのお気に入り登録数<?= $StD["favorite_count"] ?></label><br>
      <label><input type="radio" name="roomtype" value="ラージダブルルーム">ラージダブルルーム　　　★みんなのお気に入り登録数<?= $LgD["favorite_count"] ?></label><br>
      <label><input type="radio" name="roomtype" value="スーペリアダブルルーム">スーペリアダブルルーム　★みんなのお気に入り登録数<?= $SpD["favorite_count"] ?></label><br>
      <label><input type="radio" name="roomtype" value="スタンダードスタジオ">スタンダードスタジオ　　★みんなのお気に入り登録数<?= $StS["favorite_count"] ?></label><br>
      <label><input type="radio" name="roomtype" value="スーペリアスタジオ">スーペリアスタジオ　　　★みんなのお気に入り登録数<?= $DxS["favorite_count"] ?></label><br>
      <label><input type="radio" name="roomtype" value="デラックススタジオ">デラックススタジオ　　　★みんなのお気に入り登録数<?= $SpS["favorite_count"] ?></label>
    </div>
  </div>
  <div class="item no-label">
    <input type="submit">
  </div>
</form>

<style>
.contact-form {
  border: 1px solid #ccc;
  padding: 10px;
  font-size: 13px;
  font-family: sans-serif;
}
.contact-form .item {
  display: block;
  overflow: hidden;
  margin-bottom: 10px;
}
.contact-form .item.no-label {
  padding: 5px 0px 5px 60px;
}
.contact-form .item .label {
  float: left;
  padding: 5px;
  margin:0;
}
.contact-form .item .radio-group{
  padding: 5px 0px 5px 60px;
}
.contact-form .item input[type=text],
.contact-form .item input[type=email],
.contact-form .item textarea {
  display: block;
  margin-left: 60px;
  width: 200px;
  padding: 5px;
  border: 1px solid #ccc;
  box-sizing: border-box;
  font-size: 13px;
}
.contact-form .item ::placeholder {
  color: #ccc;
}
.contact-form .item textarea {
  outline: none;
  border: 1px solid #ccc;
  resize: vertical;
}
input[type=submit] {
  border: none;
  outline: none;
  display: block;
  line-height: 30px;
  width: 160px;
  text-align: center;
  font-size: 13px;
  color: #fff;
  background-color: #696;
  border-bottom: 4px solid #464;
  cursor:pointer;

  box-sizing: content-box;
  transition:0.3s ease all
}
input[type=submit]:hover{
  border-bottom-width:0;
  transform:translateY(4px)
}
</style>
</body>

</html>