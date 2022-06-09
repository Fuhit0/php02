<?php

function connect_to_db()
{
  $dbn='mysql:dbname=gsacf_d11_10;charset=utf8mb4;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';
  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    exit('dbError:'.$e->getMessage());
  }
}