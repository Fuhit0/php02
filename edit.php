<?php

// DB接続
include('function.php');
$pdo = connect_to_db();

$reservation_id = $_GET['id'];

$sql = 'SELECT * FROM reservations_table WHERE reservation_id=:reservation_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':reservation_id', $reservation_id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);

?>

// 以下HTML部分
<form action="update.php" method="POST">
  <fieldset>
    <legend>予約編集画面</legend>
    <a href="read.php">予約履歴画面</a>
    <div>
      user_name: <input type="text" name="user_name" value="<?= $record['user_name'] ?>">
    </div>
    <div>
      mail: <input type="text" name="mail" value="<?= $record['mail'] ?>">
    </div>
    <div>
      check_in: <input type="date" name="check_in" value="<?= $record['check_in'] ?>">
    </div>
    <div>
      check_out: <input type="date" name="check_out" value="<?= $record['check_out'] ?>">
    </div>
    <div>
      people: <input type="number" name="people" value="<?= $record['people'] ?>">
    </div>
    <div>
      <input type="hidden" name="reservation_id" value="<?= $record['reservation_id'] ?>">
    </div>
    <div>
      <button>submit</button>
    </div>
  </fieldset>
</form>