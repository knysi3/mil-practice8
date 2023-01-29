<?php
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function db_conn(){
    try {
      $db_name = "kon123_mil_practice_8";
      $db_id   = "kon123";
      $db_pw   = "Zaq12wsx";
      $db_host = "mysql57.kon123.sakura.ne.jp";
      $db_port = "3306";
      $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host.';port='.$db_port.'', $db_id, $db_pw);
      return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header('Location: ' .$file_name);
}
?>