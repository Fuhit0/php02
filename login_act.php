<?php
session_start();
// データ受け取り
// var_dump($_POST);
// exit();

// DB接続
include("function.php");

$username = $_POST["username"];
$password = $_POST["password"];

$pdo = connect_to_db();

// SQL実行
$sql = "SELECT * FROM users_table WHERE username =:username AND password =:password AND is_deleted=0" ;

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":username", $username, PDO::PARAM_STR);
$stmt->bindValue(":password", $password, PDO::PARAM_STR);

try{
    $satatus = $stmt->execute();
}catch(PDOException $e){
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// ユーザ有無で条件分岐
$val = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($val);
// exit();

if(!$val){
//NG
echo "<p>ご入力いただいた会員情報に誤りがあります</p>";
echo "<a href='login.php'>ログイン画面へ戻る</a>";
}else{
//OK
$_SESSION = array();
$_SESSION["session_id"] = session_id();
$_SESSION["username"] = $val["username"];
$_SESSION["is_admin"] = $val["is_admin"];
header("Location:read.php");
exit();
};