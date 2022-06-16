<?php
session_start();
include("function.php");
check_session_id();
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
      <label><input type="radio" name="roomtype" value="スタンダードダブルルーム">スタンダードダブルルーム</label><br>
      <label><input type="radio" name="roomtype" value="ラージダブルルーム">ラージダブルルーム</label><br>
      <label><input type="radio" name="roomtype" value="スーペリアダブルルーム">スーペリアダブルルーム</label><br>
      <label><input type="radio" name="roomtype" value="スタンダードスタジオ">スタンダードスタジオ</label><br>
      <label><input type="radio" name="roomtype" value="スーペリアスタジオ">スーペリアスタジオ</label><br>
      <label><input type="radio" name="roomtype" value="デラックススタジオ">デラックススタジオ</label>
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